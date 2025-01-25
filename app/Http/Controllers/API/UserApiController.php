<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//----model namespace
use App\Models\User;
use App\Models\PartnerRegOtp;


use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use OpenApi\Annotations as OA;
/**
 * @OA\OpenApi( 
 *     @OA\Info(
 *         title="My API",
 *         version="1.0.0",
 *         description="This is a sample API documentation"
 *     ),
 * )
 */
class UserApiController extends Controller
{

    /**
 * @OA\Post(
 *     path="/api/user/logout",
 *     summary="Logout the authenticated user",
 *     tags={"Authentication"},
 *     security={{"sanctum":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Logout successful",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Logout successful")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="User not authenticated",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="User not authenticated")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error"
 *     )
 * )
 */
public function logout_user(Request $request)
{
    try {
        // Revoke the user's current token
        $request->user()->currentAccessToken()->delete();

        // Return success response
        return response()->json([
            'status' => true,
            'data' => [
                'message' => 'Logout successful',
            ],
        ], 200);

    } catch (\Exception $e) {
        // Handle any exceptions and return a 500 response
        return response()->json([
            'status' => false,
            'data' => [
                'message' => 'Internal server error',
            ],
        ], 500);
    }
}
   /**
 * @OA\Post(
 *     path="/api/user/send-otp",
 *     summary="Send OTP to a mobile number",
 *     tags={"Authentication"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"mobile_no"},
 *             @OA\Property(property="mobile_no", type="string", example="1111122211")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OTP sent successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="OTP sent")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Validation error",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="The mobile_no field is required.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error"
 *     )
 * )
 */
public function sendOtp(Request $request)
{
    // Validate the request data
    $validator = Validator::make($request->all(), [
        'mobile_no' => 'required|digits_between:7,15', // Fixed validation rule
    ]);

    // If validation fails, return a 400 response with error details
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'data' => [
                'message' => $validator->errors()->first(),
            ],
        ], 400);
    }

    try {
        // Find or create a user with the provided mobile number
        $user = User::where('mobile_no', $request->mobile_no)
        ->where('role_id', 2)
        ->first();

        // If no user found, create a new user with role_id = 2
        if (!$user) {
            $user = User::create([
                'mobile_no' => $request->mobile_no,
                'role_id' => 2, // Ensure role_id is set to 2
                'username' => $request->mobile_no,
                'email' => $request->mobile_no,
                'name' => 'User',
                'password' => Hash::make('123456') // Set a default password
            ]);
        }

        // Check if user has the correct role
        if ($user->role_id !== 2) {
            return response()->json([
                'status' => false,
                'data' => [
                    'message' => 'User is not authorized to receive OTP',
                ],
            ], 403);
        }

        // Generate a new OTP
        $otp = mt_rand(100000, 999999); // Generate a random 6-digit OTP

        // Calculate expiration time (e.g., 10 minutes from now)
        $expireAt = Carbon::now()->addMinutes(10);

        // Store OTP in the partner_reg_otp table
        PartnerRegOtp::create([
            'user_id' => $user->id,
            'mobile_no' => $request->mobile_no,
            'mobile_otp' => $otp,
            'expire_at' => $expireAt,
        ]);

        // Send OTP via SMS (implement SMS service here)
        // Example: SmsService::send($request->mobile_no, "Your OTP code is: $otp");

        return response()->json([
            'status' => true,
            'data' => [
                'message' => 'OTP sent successfully'.$otp,
            ],
        ], 200);

    } catch (\Exception $e) {
        // Handle any exceptions and return a 500 response
        return response()->json([
            'status' => false,
            'data' => [
                'message' => 'Internal server error',
                'error' => $e->getMessage(),
            ],
        ], 500);
    }
}

/**
     * @OA\Post(
     *     path="/api/user/verify-otp",
     *     summary="Verify OTP for a mobile number",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"mobile_no", "otp"},
     *             @OA\Property(property="mobile_no", type="string", example="1111122211"),
     *             @OA\Property(property="otp", type="string", example="123456")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OTP verified successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="token", type="string", example="your_generated_token"),
     *             @OA\Property(property="message", type="string", example="OTP verified successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid or expired OTP",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Invalid OTP")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="User not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
    public function verifyOtp(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'mobile_no' => 'required|digits_between:7,15', // Adjusted validation rule
            'otp' => 'required|digits:6',
        ]);
    
        // If validation fails, return a 400 response with error details
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'data' => [
                    'message' => $validator->errors()->first(),
                ],
            ], 400);
        }
    
        // Find the OTP record for the given mobile number and OTP
        $otpRecord = PartnerRegOtp::where('mobile_no', $request->mobile_no)
            ->where('mobile_otp', $request->otp)
            ->where('expire_at', '>', Carbon::now()) // Ensure OTP is not expired
            ->first();
    
        // If OTP record is not found or expired, return an error
        if (!$otpRecord) {
            return response()->json([
                'status' => false,
                'data' => [
                    'message' => 'Invalid or expired OTP',
                ],
            ], 400);
        }
    
        // Find the user by mobile number and ensure the role_id is 2
        $user = User::where('mobile_no', $request->mobile_no)
                    ->where('role_id', 2) // Ensure the user has the correct role
                    ->first();
    
        // If user is not found or does not have the correct role, return an error
        if (!$user) {
            return response()->json([
                'status' => false,
                'data' => [
                    'message' => 'User not found or unauthorized',
                ],
            ], 404);
        }
    
        // Clear OTP after successful verification
        $otpRecord->delete(); // Remove the OTP record
    
        // Delete all existing tokens for the user
        $user->tokens()->delete();
    
        // Update user status
        $user->update([
            'is_mobile_verified' => 1,
            'status' => '1',
        ]);
    
        // Create a new API token for the user
        $token = $user->createToken('API Token')->plainTextToken;
    
        // Return success response with the token
        return response()->json([
            'status' => true,
            'data' => [
                'message' => 'OTP verified successfully',
                'token' => $token,
            ],
        ], 200);
    }

/**
     * @OA\Post(
     *     path="/api/user/forgot-password",
     *     summary="Request password reset OTP",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"contact"},
     *             @OA\Property(property="contact", type="string", example="user@example.com or 1234554321")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OTP sent successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="OTP sent successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="User not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
    public function forgotPassword(Request $request)
    {
        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'contact' => 'required|string',
            ]);
    
            // If validation fails, return a 400 response with error details
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'data' => [
                        'message' => $validator->errors()->first(),
                    ],
                ], 400);
            }
    
            // Find user by email or mobile number with additional conditions
            $user = User::where('mobile_no', $request->contact)
                        ->where('role_id', 2)  // Ensure the user has role_id = 2
                        ->where('status', 1)  // Ensure the user is active
                        ->first();
    
            // Check if user exists
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'data' => [
                        'message' => 'User not found or not authorized',
                    ],
                ], 404);
            }
    
            // Generate OTP
            $otp = mt_rand(100000, 999999); // Generate a random 6-digit OTP
            $otpExpiry = Carbon::now()->addMinutes(10); // OTP expires in 10 minutes
    
            // Update user with OTP and OTP generated time
            $user->otp = $otp;
            $user->otp_generated_at = $otpExpiry;
            $user->save();
    
            return response()->json([
                'status' => true,
                'data' => [
                    'message' => 'OTP sent successfully'.$otp,
                    // Uncomment the next line if you want to return the OTP in the response (for debugging)
                    // 'otp' => $otp,
                ],
            ], 200);
    
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json([
                'status' => false,
                'data' => [
                    'message' => 'An error occurred',
                    'error' => $e->getMessage(), // Optional: include the exception message for debugging
                ],
            ], 500);
        }
    }

     /**
     * @OA\Post(
     *     path="/api/user/verify_forget_password_otp",
     *     summary="Verify OTP and issue token",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"contact", "otp"},
     *             @OA\Property(property="contact", type="string", example="user@example.com or 1234554321"),
     *             @OA\Property(property="otp", type="string", example="123456")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OTP verified successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="OTP verified successfully"),
     *             @OA\Property(property="token", type="string", example="your_generated_token_here")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid OTP or expired OTP",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Invalid OTP or OTP expired")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="User not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
    public function verify_ForgetPassword_Otp(Request $request)
    {
        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'contact' => 'required|string',
                'otp' => 'required|string',
            ]);
    
            // If validation fails, return a 400 response with error details
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'data' => [
                        'message' => $validator->errors()->first(),
                    ],
                ], 400);
            }
    
            // Find user by email or mobile number
            $user = User::where('mobile_no', $request->contact)->first();
    
            // Check if user exists
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'data' => [
                        'message' => 'User not found',
                    ],
                ], 404);
            }
    
            // Check if the OTP matches and is within the expiry time
            if ($user->otp !== $request->otp || Carbon::now()->greaterThan($user->otp_generated_at)) {
                return response()->json([
                    'status' => false,
                    'data' => [
                        'message' => 'Invalid OTP or OTP expired',
                    ],
                ], 400);
            }
    
            // Remove all existing tokens for the user
            $user->tokens()->delete();
            // Generate a new API token
            $token = $user->createToken('API Token')->plainTextToken;
    
            // Clear OTP data
            $user->otp = null; // Clear OTP
            $user->otp_generated_at = null; // Clear OTP expiry time
            $user->save();
    
            // Return success response with the token
            return response()->json([
                'status' => true,
                'data' => [
                    'message' => 'OTP verified successfully',
                    'token' => $token,
                ],
            ], 200);
    
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json([
                'status' => false,
                'data' => [
                    'message' => 'An error occurred',
                    'error' => $e->getMessage(), // Optional: include the exception message for debugging
                ],
            ], 500);
        }
    }

/**
     * @OA\Post(
     *     path="/api/user/change-password",
     *     summary="Change user password",
     *     tags={"user"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"new_password", "new_password_confirmation"},
     *             @OA\Property(property="new_password", type="string", example="newpassword123"),
     *             @OA\Property(property="new_password_confirmation", type="string", example="newpassword123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Password changed successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Password changed successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="The new password and confirmation password must match.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized (if the user is not authenticated)"
     *     )
     * )
     */
    public function changePassword(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'new_password' => 'required|string|min:8|confirmed',
            'new_password_confirmation' => 'required|string|min:8',
        ]);
    
        // If validation fails, return a 400 response with error details
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'data' => [
                    'message' => $validator->errors()->first(),
                ],
            ], 400);
        }
    
        // Retrieve the authenticated user
        $user = $request->user();
    
        // Check if the new password is the same as the old password
        if (Hash::check($request->new_password, $user->password)) {
            return response()->json([
                'status' => false,
                'data' => [
                    'message' => 'New password cannot be the same as the old password.',
                ],
            ], 400);
        }
    
        // Update the user's password
        $user->password = Hash::make($request->new_password);
        $user->pass_hint = $request->new_password;
        $user->is_pass_create = '1';
        $user->save();
    
        // Return success response
        return response()->json([
            'status' => true,
            'data' => [
                'pass_hint' => $request->new_password,
                'message' => 'Password changed successfully',
            ],
        ], 200);

       
    }

//-----get user detail

/**
 * @OA\Get(
 *     path="/api/user/current",
 *     summary="Get details of the currently logged-in user",
 *     description="Returns the authenticated user's details if the request is authenticated.",
 *     tags={"user"},
 *     security={{"sanctum":{}}}, 
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved user details",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="user", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="John Doe"),
 *                 @OA\Property(property="email", type="string", example="john@example.com"),
 *                 @OA\Property(property="mobile_no", type="string", example="1234567890"),
 *                 @OA\Property(property="address", type="string", example="123 Main St"),
 *                 @OA\Property(property="classname", type="string", example="100"),
 *                 @OA\Property(property="is_pass_create", type="integer", example="1 or 0"),
 *                 @OA\Property(property="facebook", type="string", example="https://facebook.com/johndoe"),
 *                 @OA\Property(property="twitter", type="string", example="https://twitter.com/johndoe"),
 *                 @OA\Property(property="instagram", type="string", example="https://instagram.com/johndoe"),
 *                 @OA\Property(property="linkedin", type="string", example="https://linkedin.com/in/johndoe"),
 *                 @OA\Property(property="student", type="object",
 *                     @OA\Property(property="school", type="string", example="ABC School"),
 *                     @OA\Property(property="state", type="string", example="California"),
 *                     @OA\Property(property="city", type="string", example="Los Angeles")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="User not authenticated",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="User not authenticated")
 *         )
 *     )
 * )
 */
public function current_user(Request $request)
{
    // Retrieve the authenticated user
    $user = $request->user();
    
    // Check if the user is authenticated
    if ($user) {
        // Load the student details if they exist
       
       
        return response()->json([
            'status' => true,
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'user_image_path' => 'upload/user/',
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
                    'mobile_no' => $user->mobile_no,
                    'state' => $user->state,
                    'city' => $user->city,
                    'pincode' => $user->pincode,
                    'address' => $user->address,
                    'image' => $user->image,
                    'pass_hint' => $user->pass_hint,
                   
                ],
            ],
        ], 200); // Return a 200 status code for success
    } else {
        return response()->json([
            'status' => false,
            'data' => [
                'message' => 'User not authenticated',
            ],
        ], 401); // Return a 401 status code for unauthenticated requests
    }
}


//end tag
    
}
