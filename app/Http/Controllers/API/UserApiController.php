<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//----model namespace
use App\Models\User;
use App\Models\PartnerRegOtp;
use App\Models\Category;
use App\Models\State; 
use App\Models\City;


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
                    'role' => $user->role->name ?? null, // If role exists
                    'category' => $user->category->name ?? null, // If category exists
                   
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
    /**
     * @OA\Get(
     *     path="/api/user/top_category",
     *     summary="Get Top Categories",
     *     description="Fetches the top categories that are active and marked as top.",
     *     tags={"Categories"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="top_categories_image_path", type="string", example="upload/categories/"),
     *                 @OA\Property(property="top_categories", type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="name", type="string", example="Electronics"),
     *                         @OA\Property(property="status", type="string", example="1"),
     *                         @OA\Property(property="parent", type="string", example="0"),
     *                         @OA\Property(property="type", type="string", example="category"),
     *                         @OA\Property(property="is_top", type="string", example="1")
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="An error occurred while processing the request."),
     *             @OA\Property(property="error", type="string", example="Exception message")
     *         )
     *     )
     * )
     */

public function getTopCategories(Request $request)  
{  
    try {
          
         $top_categories = Category::where('status', '1')  
                ->where('parent', '0')
                ->where('type', 'category')  
                ->where('is_top', '1')  
                ->orderBy('id', 'desc') 
                ->take(10)  
                ->get();  
         

        return response()->json([  
            'status' => true,  
            'data' => [  
                'top_categories_image_path' => 'upload/categories/',  
                'top_categories' => $top_categories,  
                
            ],  
        ], 200); // Status code 200 for success  

    } catch (\Exception $e) {  
        return response()->json([  
            'status' => false,  
            'message' => 'An error occurred while processing the request.',  
            'error' => $e->getMessage(),  
        ], 500); // Status code 500 for server error  
    }  
}

        /**
     * @OA\Get(
     *     path="/api/user/all_category/{type}",
     *     summary="Get All Categories",
     *     description="Fetches all categories based on the provided type.",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="type",
     *         in="path",
     *         required=true,
     *         description="Type of category (e.g., category, symptom)",
     *         @OA\Schema(type="string", example="category")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="categories_image_path", type="string", example="storage/categories/"),
     *                 @OA\Property(property="categories", type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="name", type="string", example="Health"),
     *                         @OA\Property(property="status", type="string", example="1"),
     *                         @OA\Property(property="parent", type="string", example="0"),
     *                         @OA\Property(property="type", type="string", example="category")
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="An error occurred while processing the request.")
     *         )
     *     )
     * )
     */

public function getAllCategories($type)
{
    try {
        if($type=="category" || $type=="symptom"){
            $categories = Category::where('status', '1')->where('parent', '0')->where('type', $type)->get();

        }else{
            $categories = Category::where('status', '1')->where('parent', '0')->where('type', $type)->get();

        }

        return response()->json([
            'status' => true,
            'data' => [
                'categories_image_path' => 'storage/categories/',
                'categories' => $categories,
            ],
        ], 200); // Status code 200 for success
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'An error occurred while processing the request.',
        ], 500); // Status code 500 for server error
    }
}
    /**
     * @OA\Get(
     *     path="/api/user/child_category/{parent_id}",
     *     summary="Get Child Categories",
     *     description="Fetches child categories based on the provided parent category ID.",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="parent_id",
     *         in="path",
     *         required=true,
     *         description="ID of the parent category",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="categories_image_path", type="string", example="upload/categories/"),
     *                 @OA\Property(property="categories", type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=2),
     *                         @OA\Property(property="name", type="string", example="Laptops"),
     *                         @OA\Property(property="status", type="string", example="1"),
     *                         @OA\Property(property="parent", type="integer", example=1)
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="An error occurred while processing the request.")
     *         )
     *     )
     * )
     */
public function getChildCategories($parent_id)
{
    try {
        $categories = Category::where('status', '1')
                              ->where('parent', $parent_id)
                              ->get();

        return response()->json([
            'status' => true,
            'data' => [
                'categories_image_path' => 'upload/categories/',
                'categories' => $categories,
            ],
        ], 200); // Status code 200 for success
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'An error occurred while processing the request.',
        ], 500); // Status code 500 for server error
    }
}
    /**
     * @OA\Get(
     *     path="/api/user/all_states",
     *     summary="Get All States",
     *     description="Fetches all states for the specified country.",
     *     tags={"Locations"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="states", type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="name", type="string", example="California")
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="message", type="string", example="An unexpected error occurred"),
     *                 @OA\Property(property="error", type="string", example="Exception message")
     *             )
     *         )
     *     )
     * )
     */

   public function states_all(){
        try {
            // Fetch all states, selecting only the id and state_name columns
            $states = State::select('id', 'name')->where('fcountryid',101)->get();

            return response()->json([
                'status' => true,
                'data' => [
                    'states' => $states,
                ],
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'data' => [
                    'message' => 'An unexpected error occurred',
                    'error' => $e->getMessage(),
                ],
            ], 500);
        }
    }
   /**
 * @OA\Get(
 *     path="/api/user/all_districts",
 *     summary="Get All Districts",
 *     description="Fetches all districts based on the provided state ID.",
 *     tags={"Locations"},
 *     @OA\Parameter(
 *         name="fk_state_id",
 *         in="query",
 *         required=true,
 *         description="ID of the state to fetch districts for",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful response",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="boolean", example=true),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="districts", type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         @OA\Property(property="id", type="integer", example=101),
 *                         @OA\Property(property="name", type="string", example="Los Angeles")
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad request - Validation error",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="boolean", example=false),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="message", type="string", example="The fk_state_id field is required.")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No districts found",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="boolean", example=false),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="message", type="string", example="No districts found for the given state ID"),
 *                 @OA\Property(property="districts", type="array",
 *                     @OA\Items(type="object")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server error",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="boolean", example=false),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="message", type="string", example="An unexpected error occurred"),
 *                 @OA\Property(property="error", type="string", example="Exception message")
 *             )
 *         )
 *     )
 * )
 */

public function districts_all(Request $request){
    // Validate the request data
    
    $validator = Validator::make($request->all(), [
        'fk_state_id' => 'required|integer',
    ]);

    // Return error response if validation fails
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'data' => [
                'message' => $validator->errors()->first(),
            ],
        ], 400);  // Bad Request
    }

    try {
        // Fetch districts by state ID
        $stateId = $request->input('fk_state_id');
        $districts = City::where('fstateid', $stateId)
            ->select('id', 'name')
            ->get();

        // Check if any districts were found
        if ($districts->isEmpty()) {
            return response()->json([
                'status' => false,
                'data' => [
                    'message' => 'No districts found for the given state ID',
                    'districts' => [],
                ],
            ], 404);  // Not Found
        }

        return response()->json([
            'status' => true,
            'data' => [
                'districts' => $districts,
            ],
        ], 200);  // OK

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'data' => [
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage(),
            ],
        ], 500);  // Internal Server Error
    }
}
//end tag
    
}
