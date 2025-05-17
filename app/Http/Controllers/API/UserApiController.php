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
use App\Models\Slider;
use App\Models\Transaction;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Str;
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
 * @OA\Get(
 *     path="/api/get-home-data",
 *     tags={"Home"},
 *     summary="Get home page data",
 *     description="Fetches sliders, specialist categories, symptoms, and radiology categories for the home screen.",
 *     operationId="getHomeData",
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved home data",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=true),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="message", type="string", example="Successfully retrieved home data."),
 *                 @OA\Property(property="category_image_path", type="string", example="/storage/category"),

 *                 @OA\Property(
 *                     property="home_slider",
 *                     type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         @OA\Property(property="id", type="integer", example=1),
 *                         @OA\Property(property="title", type="string", example="Welcome Slide"),
 *                         @OA\Property(property="image", type="string", example="slider1.jpg"),
 *                         @OA\Property(property="url", type="string", example="https://example.com"),
 *                         @OA\Property(property="description", type="string", example="A short description of the slide."),
 *                         @OA\Property(property="status", type="string", example="1"),
 *                         @OA\Property(property="created_at", type="string", format="date-time", example="2024-04-07T10:00:00Z"),
 *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2024-04-07T10:00:00Z")
 *                     )
 *                 ),

 *                 @OA\Property(
 *                     property="specailist_category",
 *                     type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         @OA\Property(property="id", type="integer", example=1),
 *                         @OA\Property(property="name", type="string", example="Cardiology"),
 *                         @OA\Property(property="parent", type="integer", example=null),
 *                         @OA\Property(property="image", type="string", example="category1.jpg"),
 *                         @OA\Property(property="status", type="string", example="1"),
 *                         @OA\Property(property="type", type="string", example="category")
 *                     )
 *                 ),

 *                 @OA\Property(
 *                     property="symptom_category",
 *                     type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         @OA\Property(property="id", type="integer", example=2),
 *                         @OA\Property(property="name", type="string", example="Headache"),
 *                         @OA\Property(property="parent", type="integer", example=null),
 *                         @OA\Property(property="image", type="string", example="symptom1.jpg"),
 *                         @OA\Property(property="status", type="string", example="1"),
 *                         @OA\Property(property="type", type="string", example="symptom")
 *                     )
 *                 ),

 *                 @OA\Property(
 *                     property="radiology_category",
 *                     type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         @OA\Property(property="id", type="integer", example=3),
 *                         @OA\Property(property="name", type="string", example="X-Ray"),
 *                         @OA\Property(property="parent", type="integer", example=null),
 *                         @OA\Property(property="image", type="string", example="radiology1.jpg"),
 *                         @OA\Property(property="status", type="string", example="1"),
 *                         @OA\Property(property="type", type="string", example="radiology")
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="An error occurred",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=false),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="message", type="string", example="An error occurred: Something went wrong")
 *             )
 *         )
 *     )
 * )
 */

    public function Home_Category_data(Request $request)
    {
        try {
            
            // Count the total number of approved and for-sale test series
            $Slider = Slider::select('id', 'title', 'image', 'url', 'description', 'status', 'created_at', 'updated_at')
                    ->where('status', '1') 
                    ->get(); 
            $categories = Category::select('id', 'name', 'parent', 'image', 'status', 'type')  
                        ->where('type', 'category')  
                        ->where('status', '1')->limit(15)  
                        ->get();  
            $symptom = Category::select('id', 'name', 'parent', 'image', 'status', 'type')  
                        ->where('type', 'symptom')  
                        ->where('status', '1')->limit(15)  
                        ->get();  

                        $radiology = Category::select('id', 'name', 'parent', 'image', 'status', 'type')
                        ->where('type', 'category')
                        ->where('status', '1')
                        ->withCount([
                            'subcategories as children_count' => function ($query) {
                                $query->where('status', '1');
                            }
                        ])
                        ->limit(15)
                        ->get();

            // $radiology = Category::select('id', 'name', 'parent', 'image', 'status', 'type')  
            //             ->where('type', 'radiology')  
            //             ->where('status', '1')->limit(15)  
            //             ->get();  
           

            return response()->json([
                'status' => true,
                'data' => [
                    'message' => 'Successfully retrieved home data.', 
                    'category_image_path' => '/storage/category',
                    'home_slider' => $Slider,
                    'specailist_category' => $categories,
                    'symptom_category' => $symptom,
                    'radiology_category' => $radiology,
                   
                    
                ],
            ], 200); // Status code 200 for success

        } catch (\Exception $e) {
            // Log the exception message using the global Log facade
           
            return response()->json([
                'status' => false,
                'data' => [
                    'message' => 'An error occurred: ' . $e->getMessage()

                ],
            ], 500); // Status code 500 for server error
        }
    }

    /**
 * @OA\Get(
 *     path="/api/all-specialist-categories",
 *     tags={"Categories"},
 *     summary="Get all approved specialist categories",
 *     description="Returns a list of approved specialist categories.",
 *     operationId="getAllSpecialCategory",
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved special categories",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=true),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="message", type="string", example="Successfully retrieved special categories."),
 *                 @OA\Property(property="category_image_path", type="string", example="/storage/category"),
 *                 @OA\Property(
 *                     property="specialist_category",
 *                     type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         @OA\Property(property="id", type="integer", example=1),
 *                         @OA\Property(property="name", type="string", example="Cardiology"),
 *                         @OA\Property(property="parent", type="integer", example=null),
 *                         @OA\Property(property="image", type="string", example="cardiology.jpg"),
 *                         @OA\Property(property="status", type="string", example="1"),
 *                         @OA\Property(property="type", type="string", example="category")
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No special categories found",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=false),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="message", type="string", example="No special categories found.")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server error",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=false),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="message", type="string", example="An error occurred: Something went wrong")
 *             )
 *         )
 *     )
 * )
 */

    public function getAllSpecialCategory(Request $request)  
    {  
        try {  
            // Fetch approved special categories  
            $categories = Category::select('id', 'name', 'parent', 'image', 'status', 'type')  
                ->where('type', 'category')  
                ->where('status', '1')  
                ->get();  
    
            // Check if categories were found  
            if ($categories->isEmpty()) {  
                return response()->json([  
                    'status' => false,  
                    'data' => [  
                        'message' => 'No special categories found.',  
                    ],  
                ], 404); // Using 404 for not found  
            }  
    
            // Return categories if found  
            return response()->json([  
                'status' => true,  
                'data' => [  
                    'message' => 'Successfully retrieved special categories.', 
                    'category_image_path' => '/storage/category',  
                    'specialist_category' => $categories,  
                    
                ],  
            ], 200); // Status code 200 for success  
    
        } catch (\Exception $e) {  
            // Log the exception message using the global Log facade  
            Log::error('Error fetching special categories: ' . $e->getMessage());  
    
            return response()->json([  
                'status' => false,  
                'data' => [  
                    'message' => 'An error occurred: ' . $e->getMessage(),  
                ],  
            ], 500); // Status code 500 for server error  
        }  
    }  
    
    /**
 * @OA\Get(
 *     path="/api/all-symptom-categories",
 *     tags={"Categories"},
 *     summary="Get all approved symptom categories",
 *     description="Returns a list of approved symptom categories.",
 *     operationId="getAllSymptomCategory",
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved symptom categories",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=true),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="message", type="string", example="Successfully retrieved symptom categories."),
 *                 @OA\Property(property="category_image_path", type="string", example="/storage/category"),
 *                 @OA\Property(
 *                     property="symptom_category",
 *                     type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         @OA\Property(property="id", type="integer", example=1),
 *                         @OA\Property(property="name", type="string", example="Headache"),
 *                         @OA\Property(property="parent", type="integer", example=null),
 *                         @OA\Property(property="image", type="string", example="headache.jpg"),
 *                         @OA\Property(property="status", type="string", example="1"),
 *                         @OA\Property(property="type", type="string", example="symptom")
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No symptom categories found",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=false),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="message", type="string", example="No symptom categories found.")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server error",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=false),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="message", type="string", example="An error occurred: Something went wrong")
 *             )
 *         )
 *     )
 * )
 */

    public function getAllSymptomCategory(Request $request)  
    {  
        try {  
            // Fetch approved symptom categories  
            $symptoms = Category::select('id', 'name', 'parent', 'image', 'status', 'type')  
                ->where('type', 'symptom')  
                ->where('status', '1')  
                ->get();  
    
            // Check if symptoms were found  
            if ($symptoms->isEmpty()) {  
                return response()->json([  
                    'status' => false,  
                    'data' => [  
                        'message' => 'No symptom categories found.',  
                    ],  
                ], 404); // Using 404 for not found  
            }  
    
            // Return symptoms if found  
            return response()->json([  
                'status' => true,  
                'data' => [  
                    'message' => 'Successfully retrieved symptom categories.',
                    'category_image_path' => '/storage/category',   
                    'symptom_category' => $symptoms,  
                    
                ],  
            ], 200); // Status code 200 for success  
    
        } catch (\Exception $e) {  
            // Log the exception message using the global Log facade  
            Log::error('Error fetching symptom categories: ' . $e->getMessage());  
    
            return response()->json([  
                'status' => false,  
                'data' => [  
                    'message' => 'An error occurred: ' . $e->getMessage(),  
                ],  
            ], 500); // Status code 500 for server error  
        }  
    }  

    /**
 * @OA\Get(
 *     path="/api/all-radiology-categories",
 *     tags={"Categories"},
 *     summary="Get all approved radiology categories",
 *     description="Returns a list of approved radiology categories.",
 *     operationId="getAllRadiologyCategory",
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved radiology categories",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=true),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="message", type="string", example="Successfully retrieved radiology categories."),
 *                 @OA\Property(property="category_image_path", type="string", example="/storage/category"),
 *                 @OA\Property(
 *                     property="radiology_category",
 *                     type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         @OA\Property(property="id", type="integer", example=1),
 *                         @OA\Property(property="name", type="string", example="X-Ray"),
 *                         @OA\Property(property="parent", type="integer", example=null),
 *                         @OA\Property(property="image", type="string", example="xray.jpg"),
 *                         @OA\Property(property="status", type="string", example="1"),
 *                         @OA\Property(property="type", type="string", example="radiology")
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No radiology categories found",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=false),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="message", type="string", example="No radiology categories found.")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server error",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=false),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="message", type="string", example="An error occurred: Something went wrong")
 *             )
 *         )
 *     )
 * )
 */

    public function getAllRadiologyCategory(Request $request)  
    {  
        try {  
            // Fetch approved symptom categories  
            // $radiology = Category::select('id', 'name', 'parent', 'image', 'status', 'type')  
            // ->where('type', 'radiology')  
            // ->where('status', '1') 
            // ->get();   
            $radiology = Category::select('id', 'name', 'parent', 'image', 'status', 'type')
            ->where('type', 'category')
            ->where('status', '1')
            ->withCount([
                'subcategories as children_count' => function ($query) {
                    $query->where('status', '1');
                }
            ])
            ->get();
    
            // Check if symptoms were found  
            if ($radiology->isEmpty()) {  
                return response()->json([  
                    'status' => false,  
                    'data' => [  
                        'message' => 'No radiology categories found.',  
                    ],  
                ], 404); // Using 404 for not found  
            }  
    
            // Return symptoms if found  
            return response()->json([  
                'status' => true,  
                'data' => [  
                    'message' => 'Successfully retrieved radiology categories.', 
                    'category_image_path' => '/storage/category',  
                    'radiology_category' => $radiology,  
                     
                ],  
            ], 200); // Status code 200 for success  
    
        } catch (\Exception $e) {  
            // Log the exception message using the global Log facade  
            Log::error('Error fetching radiology categories: ' . $e->getMessage());  
    
            return response()->json([  
                'status' => false,  
                'data' => [  
                    'message' => 'An error occurred: ' . $e->getMessage(),  
                ],  
            ], 500); // Status code 500 for server error  
        }  
    }  

    public function getAllHospital(Request $request)  
    {  
        try {  
            // Fetch approved hospitals with specified fields and eager load relationships  
            $hospitals = User::select('id', 'name', 'mobile_no', 'email', 'pincode', 'address', 'image', 'short_description')  
                ->where('role_id', '3')  
                ->where('status', '1')  
                ->with(['state', 'city'])  // Eager loading state and city with specific fields  
                ->get();  

            // Check if hospitals were found  
            if ($hospitals->isEmpty()) {  
                return response()->json([  
                    'status' => false,  
                    'data' => [  
                        'message' => 'No hospitals found.',  
                    ],  
                ], 404); // Using 404 for not found  
            }  

            // Format the hospitals response to include state_name and city_name  
            $formattedHospitals = $hospitals->map(function ($hospital) {  
                return [  
                    'name' => $hospital->name,  
                    'mobile_no' => $hospital->mobile_no,  
                    'email' => $hospital->email,  
                    'pincode' => $hospital->pincode,  
                    'address' => $hospital->address,  
                    'image' => $hospital->image,  
                    'short_description' => $hospital->short_description,  
                    'state_name' => $hospital->state->name ?? null,  // Check if state exists  
                    'city_name' => $hospital->city->name ?? null,    // Check if city exists  
                    'distance' => '14 KM',    // Check if city exists  
                ];  
            });  

            // Return hospitals if found  
            return response()->json([  
                'status' => true,  
                'data' => [  
                    'message' => 'Successfully retrieved hospitals data.',   
                    'image_path' => '/storage/hospital',  // Base path for images if needed  
                    'hospitals' => $formattedHospitals,  // Renamed variable for clarity  
                ],  
            ], 200); // Status code 200 for success  

        } catch (\Exception $e) {  
            // Log the exception message using the global Log facade  
            Log::error('Error fetching hospitals: ' . $e->getMessage());  
    
            return response()->json([  
                'status' => false,  
                'data' => [  
                    'message' => 'An error occurred: ' . $e->getMessage(),  
                ],  
            ], 500); // Status code 500 for server error  
        }  
    }  


    
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

/**
 * @OA\Get(
 *     path="/api/user/get_doctor_bycategory/{category_id}",
 *     summary="Get doctors by specialist category",
 *     description="Fetches a paginated list of doctors by category ID with hospital, city, and state details.",
 *     operationId="getDoctorsBySpecialistCategory",
 *     tags={"Doctor"},
 *     @OA\Parameter(
 *         name="category_id",
 *         in="path",
 *         required=true,
 *         description="Category ID for which doctors are to be fetched",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Doctors fetched successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="boolean", example=true),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="message", type="string", example="Doctors fetched successfully"),
 *                 @OA\Property(property="test_series_image_path", type="string", example="storage/doctor/"),
 *                 @OA\Property(property="doctors", type="object",
 *                     description="Paginated list of doctors with related hospital, city, and state info"
 *                    
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Unexpected error",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="boolean", example=true),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="message", type="string", example="An unexpected error occurred"),
 *                 @OA\Property(property="error", type="string", nullable=true)
 *             )
 *         )
 *     )
 * )
 */

public function Doctor_get_by_Specilist(Request $request,$category_id)  
{
    try {
        // Validate input
       

        $categoryId = $category_id;

        $doctors = User::from('users as doctors')
            ->leftJoin('state', 'doctors.state', '=', 'state.id')
            ->leftJoin('city', 'doctors.city', '=', 'city.id')
            ->leftJoin('users as hospitals', function($join) {
                $join->on('doctors.user_id', '=', 'hospitals.id')
                     ->where('hospitals.type', 'hospital'); 
            })
            ->whereRaw('FIND_IN_SET(?, doctors.category_id) > 0', [$categoryId]) 
            ->where('doctors.status', '1')
            ->where('doctors.type', '4')
            ->select([
                'doctors.id',
                'doctors.user_id',
                'doctors.role_id',
                'doctors.category_id',
                'doctors.symptom_id',
               
                'doctors.name',
                'doctors.type',
                'doctors.mobile_no',
                'doctors.email',
                'doctors.pincode',
                'doctors.address',
                'doctors.experience',
                'doctors.price',
                'doctors.qualification',
                'doctors.device_id',
                'doctors.short_description',
                'doctors.status',
                'doctors.image',
                'state.name as state_name',
                'city.name as city_name',
                'hospitals.name as hospital_name'
            ])
            ->paginate(15);

        return response()->json([
            'status' => true,
            'data' => [
                'message' => 'Doctors fetched successfully',
                'test_series_image_path' => 'storage/doctor/',
                'doctors' => $doctors,
            ]
        ], 200);


    } catch (Exception $e) {
        Log::error('Doctor fetch error: ' . $e->getMessage());
        
        return response()->json([
            'status' => true,
            'data' => [
                'message' => 'An unexpected error occurred',
                'error' => config('app.debug') ? $e->getMessage() : null
            ]
        ], 500);
    }
}
/**
 * @OA\Get(
 *     path="/api/user/get_doctor_byhospital/{hospital_id}",
 *     summary="Get doctors by hospital ID",
 *     description="Fetches a paginated list of doctors that belong to a specific hospital, including city and state information.",
 *     operationId="getDoctorsByHospital",
 *     tags={"Doctor"},
 *     @OA\Parameter(
 *         name="hospital_id",
 *         in="path",
 *         required=true,
 *         description="Hospital ID to fetch associated doctors",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Doctors fetched successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="boolean", example=true),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="message", type="string", example="Doctors fetched successfully"),
 *                 @OA\Property(property="test_series_image_path", type="string", example="storage/doctor/"),
 *                 @OA\Property(property="doctors", type="object",
 *                     description="Paginated list of doctors from the specified hospital"
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Unexpected error",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="boolean", example=true),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="message", type="string", example="An unexpected error occurred"),
 *                 @OA\Property(property="error", type="string", nullable=true)
 *             )
 *         )
 *     )
 * )
 */

public function Doctor_get_by_Hospital(Request $request,$hsopital_id)  
{
    try {
       
        $hsopital_id = $hsopital_id;

        $doctors = User::from('users as doctors')
            ->leftJoin('state', 'doctors.state', '=', 'state.id')
            ->leftJoin('city', 'doctors.city', '=', 'city.id')
            ->leftJoin('users as hospitals', function($join) {
                $join->on('doctors.user_id', '=', 'hospitals.id')
                     ->where('hospitals.type', 'hospital'); 
            })
            ->where('doctors.user_id', $hsopital_id)
            ->where('doctors.status', '1')
            ->where('doctors.type', '4')
            ->select([
                'doctors.id',
                'doctors.user_id',
                'doctors.role_id',
                'doctors.category_id',
                'doctors.symptom_id',
                'doctors.name',
                'doctors.type',
                'doctors.mobile_no',
                'doctors.email',
                'doctors.pincode',
                'doctors.address',
                'doctors.experience',
                'doctors.price',
                'doctors.qualification',
                'doctors.device_id',
                'doctors.short_description',
                'doctors.status',
                'doctors.image',
                'state.name as state_name',
                'city.name as city_name',
                'hospitals.name as hospital_name'
            ])
            ->paginate(15);

        return response()->json([
            'status' => true,
            'data' => [
                'message' => 'Doctors fetched successfully',
                'test_series_image_path' => 'storage/doctor/',
                'doctors' => $doctors,
            ]
        ], 200);


    } catch (Exception $e) {
        Log::error('Doctor fetch error: ' . $e->getMessage());
        
        return response()->json([
            'status' => true,
            'data' => [
                'message' => 'An unexpected error occurred',
                'error' => config('app.debug') ? $e->getMessage() : null
            ]
        ], 500);
    }
}


/**
 * @OA\Get(
 *     path="/api/user/get_doctor_bysymptom/{symptom_id}",
 *     summary="Get doctors by symptom ID",
 *     description="Fetches a paginated list of doctors based on a symptom ID. Includes hospital, city, and state information.",
 *     operationId="getDoctorsBySymptom",
 *     tags={"Doctor"},
 *     @OA\Parameter(
 *         name="symptom_id",
 *         in="path",
 *         required=true,
 *         description="Symptom ID to filter doctors",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Doctors fetched successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="boolean", example=true),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="message", type="string", example="Doctors fetched successfully"),
 *                 @OA\Property(property="test_series_image_path", type="string", example="storage/doctor/"),
 *                 @OA\Property(property="doctors", type="object",
 *                     description="Paginated list of doctors matching the symptom"
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Unexpected error",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="boolean", example=true),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="message", type="string", example="An unexpected error occurred"),
 *                 @OA\Property(property="error", type="string", nullable=true)
 *             )
 *         )
 *     )
 * )
 */

public function Doctor_get_by_Symptom(Request $request,$symptom_id)  
{
    try {
        // Validate input
        $symptom_id = $symptom_id;

        $doctors = User::from('users as doctors')
            ->leftJoin('state', 'doctors.state', '=', 'state.id')
            ->leftJoin('city', 'doctors.city', '=', 'city.id')
            ->leftJoin('users as hospitals', function($join) {
                $join->on('doctors.user_id', '=', 'hospitals.id')
                     ->where('hospitals.type', 'hospital'); 
            })
            ->whereRaw('FIND_IN_SET(?, doctors.symptom_id) > 0', [$symptom_id]) 
            ->where('doctors.status', '1')
            ->where('doctors.type', '4')
            ->select([
                'doctors.id',
                'doctors.user_id',
                'doctors.role_id',
                'doctors.category_id',
                'doctors.symptom_id',
                'doctors.name',
                'doctors.type',
                'doctors.mobile_no',
                'doctors.email',
                'doctors.pincode',
                'doctors.address',
                'doctors.experience',
                'doctors.price',
                'doctors.qualification',
                'doctors.device_id',
                'doctors.short_description',
                'doctors.status',
                'doctors.image',
                'state.name as state_name',
                'city.name as city_name',
                'hospitals.name as hospital_name'
            ])
            ->paginate(15);

        return response()->json([
            'status' => true,
            'data' => [
                'message' => 'Doctors fetched successfully',
                'test_series_image_path' => 'storage/doctor/',
                'doctors' => $doctors,
            ]
        ], 200);

  
    } catch (Exception $e) {
        Log::error('Doctor fetch error: ' . $e->getMessage());
        
        return response()->json([
            'status' => true,
            'data' => [
                'message' => 'An unexpected error occurred',
                'error' => config('app.debug') ? $e->getMessage() : null
            ]
        ], 500);
    }
}

/**
 * @OA\Get(
 *     path="/api/user/get_singledoctor_detail/{doctor_id}",
 *     summary="Get single doctor details",
 *     description="Fetches detailed information of a doctor including schedule slots, location, and hospital.",
 *     operationId="getSingleDoctorDetails",
 *     tags={"Doctor"},
 *     @OA\Parameter(
 *         name="doctor_id",
 *         in="path",
 *         required=true,
 *         description="Doctor ID",
 *         @OA\Schema(type="integer", example=12)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Doctor details fetched successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="boolean", example=true),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="message", type="string", example="Doctor details fetched successfully"),
 *                 @OA\Property(property="image_path", type="string", example="storage/doctor/"),
 *                 @OA\Property(property="doctor", type="object",
 *                     description="Doctor detail object"
 *                 ),
 *                 @OA\Property(property="schedule_list", type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         @OA\Property(property="id", type="integer", example=1),
 *                         @OA\Property(property="date", type="string", format="date", example="2025-05-15"),
 *                         @OA\Property(property="start_time", type="string", example="09:00"),
 *                         @OA\Property(property="end_time", type="string", example="13:00"),
 *                         @OA\Property(property="slot_duration", type="integer", example=30),
 *                         @OA\Property(property="max_slot", type="integer", example=10),
 *                         @OA\Property(property="shift", type="string", example="Morning"),
 *                         @OA\Property(property="status", type="string", example="active")
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid doctor ID format",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Invalid doctor ID format")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Doctor not found",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Doctor not found")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Unexpected server error",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=true),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="message", type="string", example="An unexpected error occurred"),
 *                 @OA\Property(property="error", type="string", nullable=true)
 *             )
 *         )
 *     )
 * )
 */

public function get_doctor_details($doctor_id)
{
    try {
        // Validate doctor_id
        if (!is_numeric($doctor_id)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid doctor ID format'
            ], 400);
        }

        $doctor = User::from('users as doctors')
            ->leftJoin('state', 'doctors.state', '=', 'state.id')
            ->leftJoin('city', 'doctors.city', '=', 'city.id')
            ->leftJoin('users as hospitals', function($join) {
                $join->on('doctors.hospital_id', '=', 'hospitals.id')
                     ->where('hospitals.type', 'hospital');
            })
            ->where('doctors.id', $doctor_id)
            ->where('doctors.type', '4') // Ensure it's a doctor
            ->select([
                'doctors.id',
                'doctors.name',
                'doctors.mobile_no',
                'doctors.email',
                'doctors.qualification',
                'doctors.experience',
                'doctors.price',
                'doctors.short_description',
                'doctors.address',
                'doctors.pincode',
                'doctors.image',
                'state.name as state_name',
                'city.name as city_name',
                'hospitals.name as hospital_name',
                'hospitals.id as hospital_id'
            ])
            ->first();

        if (!$doctor) {
            return response()->json([
                'status' => false,
                'message' => 'Doctor not found'
            ], 404);
        }

        $DoctorSlot = DoctorSlot::select(
            'id', 
            'date', 
            'start_time', 
            'end_time', 
            'slot_duration', 
            'max_slot', 
            'shift', 
            'status'
        )
        ->where('doctor_id', $doctor_id)
        ->whereDate('date', '>=', Carbon::today())
        ->orderBy('date', 'asc') 
        ->get();
        return response()->json([
            'status' => true,
            'data' => [
                'message' => 'Doctor details fetched successfully',
                'image_path' => 'storage/doctor/',
                'doctor' => $doctor,
                'schedule_list' => $DoctorSlot
            ]
        ], 200);

    } catch (Exception $e) {
        Log::error('Get doctor details error: ' . $e->getMessage());
        
        return response()->json([
            'status' => true,
            'data' => [
                'message' => 'An unexpected error occurred',
                'error' => config('app.debug') ? $e->getMessage() : null
            ]
        ], 500);
    }
}



/**
 * @OA\Get(
 *     path="/api/user/get_all_hospitals",
 *     summary="Get list of all active hospitals",
 *     description="Returns a paginated list of hospitals with their details, including state and city names.",
 *     operationId="getAllHospitals",
 *     tags={"Hospital"},
 *     @OA\Parameter(
 *         name="doctor_id",
 *         in="path",
 *         required=true,
 *         description="Doctor ID (not used in logic, but passed in URL)",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Hospital list fetched successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="boolean", example=true),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="message", type="string", example="Hospital fetched successfully"),
 *                 @OA\Property(property="test_series_image_path", type="string", example="storage/hospital/"),
 *                 @OA\Property(
 *                     property="hospital_list",
 *                     type="object",
 *                     description="Paginated hospital list"
 *                     
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Unexpected error",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=true),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="message", type="string", example="An unexpected error occurred"),
 *                 @OA\Property(property="error", type="string", nullable=true)
 *             )
 *         )
 *     )
 * )
 */

public function get_AllHospital(Request $request)  
{
    try {
        // Validate input
      

        $hospitals = User::from('users as hospitals')
            ->leftJoin('state', 'hospitals.state', '=', 'state.id')
            ->leftJoin('city', 'hospitals.city', '=', 'city.id')
            ->where('hospitals.status', '1')
            ->where('hospitals.type', '3')
            ->select([
                'hospitals.id',
                'hospitals.user_id',
                'hospitals.role_id',
                'hospitals.category_id',
                'hospitals.name',
                'hospitals.type',
                'hospitals.mobile_no',
                'hospitals.email',
                'hospitals.pincode',
                'hospitals.address',
                'hospitals.experience',
                'hospitals.price',
                'hospitals.qualification',
                'hospitals.device_id',
                'hospitals.short_description',
                'hospitals.status',
                'hospitals.image',
                'state.name as state_name',
                'city.name as city_name'
                
            ])
            ->paginate(15);

        return response()->json([
            'status' => true,
            'data' => [
                'message' => 'Hospital fetched successfully',
                'test_series_image_path' => 'storage/hospital/',
                'hospital_list' => $hospitals,
            ]
        ], 200);

    } catch (Exception $e) {
        Log::error('hospital fetch error: ' . $e->getMessage());
        

        return response()->json([
            'status' => true,
            'data' => [
                'message' => 'An unexpected error occurred',
                'error' => config('app.debug') ? $e->getMessage() : null
            ]
        ], 500);
      
    }
}
/**
 * @OA\Post(
 *     path="/api/user/doctor-add-to-cart",
 *     summary="Add doctor appointment to cart",
 *     tags={"User"},
 *     security={{"bearerAuth": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"doctor_id", "booking_date"},
 *             @OA\Property(property="doctor_id", type="integer", example=1, description="Doctor's unique ID"),
 *             @OA\Property(property="booking_date", type="string", format="date", example="2025-05-20", description="Booking date for the doctor appointment")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Doctor appointment added to cart successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=true),
 *             @OA\Property(property="data", type="object", 
 *                 @OA\Property(property="message", type="string", example="Doctor appointment added to cart successfully"),
 *                 @OA\Property(property="cart", type="object", 
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="user_id", type="integer", example=1),
 *                     @OA\Property(property="doctor_id", type="integer", example=1),
 *                     @OA\Property(property="price", type="number", example=100)
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation failed",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=false),
 *             @OA\Property(property="data", type="object", 
 *                 @OA\Property(property="message", type="string", example="Validation failed"),
 *                 @OA\Property(property="errors", type="object")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Failed to add to cart",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=false),
 *             @OA\Property(property="data", type="object", 
 *                 @OA\Property(property="message", type="string", example="Failed to add to cart"),
 *                 @OA\Property(property="error", type="string", example="Error message here")
 *             )
 *         )
 *     )
 * )
 */
public function DoctoraddToCartAPP(Request $request)
{
    $validator = Validator::make($request->all(), [
        'doctor_id' => 'required',
        'booking_date' => 'required|date|after_or_equal:today',
       
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'data' => [
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ]
        ], 422);
     
    }

    try {
        $user = $request->user(); // Authenticated user

        $doctor = User::findOrFail($request->doctor_id);


    // Cart data (from your form or request)
    $cartData = [
        'user_id' => $user->id,
        'hospital_id' => $doctor->user_id,
        'doctor_id' => $request->doctor_id,
        'p_name' => $doctor->name,
        'booking_date' => $request->booking_date,
        'qty' => '1',
        'price' => $doctor->price,
        'gst' => '0',
        'total' => $doctor->price,
        'type' => 'doctor',
        'created_at' => now(),
    ];
        // Insert the data into the cart table
        $cart = Cart::create($cartData);
        
        return response()->json([
            'status' => true,
            'data' => [
               'message' => 'Doctor appointment added to cart successfully',
               'cart' => $cart
            ]
        ], 200);
     

    } catch (\Exception $e) {

        return response()->json([
            'status' => false,
            'data' => [
                'message' => 'Failed to add to cart',
                'error' => $e->getMessage()
            ]
        ], 500);
     
    }
}

/**
 * @OA\Post(
 *     path="/api/user/doctor-order-submit",
 *     summary="Submit payment for doctor appointment",
 *     tags={"User"},
 *     security={{"bearerAuth": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"cart_id", "payment_option", "full_name", "gender", "age", "mobile", "email"},
 *             @OA\Property(property="cart_id", type="integer", example=1, description="Cart ID to submit payment for"),
 *             @OA\Property(property="payment_option", type="string", enum={"cash", "online"}, example="online", description="Payment option for the appointment"),
 *             @OA\Property(property="full_name", type="string", example="John Doe", description="Full name of the person making the appointment"),
 *             @OA\Property(property="father_name", type="string", example="John Senior", description="Father's name (optional)"),
 *             @OA\Property(property="gender", type="string", enum={"male", "female", "other"}, example="male", description="Gender of the person making the appointment"),
 *             @OA\Property(property="age", type="integer", example=30, description="Age of the person making the appointment"),
 *             @OA\Property(property="mobile", type="string", example="1234567890", description="Mobile number of the person making the appointment"),
 *             @OA\Property(property="email", type="string", example="johndoe@example.com", description="Email of the person making the appointment")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Order created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=true),
 *             @OA\Property(property="data", type="object", 
 *                 @OA\Property(property="message", type="string", example="Order created successfully. Proceed to payment."),
 *                 @OA\Property(property="order_id", type="integer", example=1),
 *                 @OA\Property(property="order_number", type="string", example="ORD20250514001"),
 *                 @OA\Property(property="amount", type="number", example=100),
 *                 @OA\Property(property="payment_status", type="string", example="pending"),
 *                 @OA\Property(property="payment_redirect", type="string", example="https://paymentgateway.com/...")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation failed",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=false),
 *             @OA\Property(property="data", type="object", 
 *                 @OA\Property(property="message", type="string", example="Validation failed"),
 *                 @OA\Property(property="errors", type="object")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Unauthorized access to cart",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=false),
 *             @OA\Property(property="data", type="object", 
 *                 @OA\Property(property="message", type="string", example="Unauthorized access to cart.")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Failed to process order",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=false),
 *             @OA\Property(property="data", type="object", 
 *                 @OA\Property(property="message", type="string", example="Order processing failed"),
 *                 @OA\Property(property="error", type="string", example="Error message here")
 *             )
 *         )
 *     )
 * )
 */
public function submitPayment(Request $request)
{
    $validator = Validator::make($request->all(), [
        'cart_id' => 'required',
        'payment_option' => 'required|in:cash,online',
        'full_name' => 'required|string',
        'father_name' => 'nullable|string',
        'gender' => 'required|in:male,female,other',
        'age' => 'required|numeric|min:0',
        'mobile' => 'required|digits:10',
        'email' => 'required|email',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'data' => [
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ]
        ], 422);
    }

    try {
        $user = $request->user();
        $cart = Cart::findOrFail($request->cart_id);

        // Ensure the cart belongs to the authenticated user
        if ($cart->user_id !== $user->id) {
            return response()->json([
                'status' => false,
                'data' => [
                    'message' => 'Unauthorized access to cart.'
                ]
            ], 403);
        }

        $order_id = $this->generateUniqueOrderId();

        $orderData = [
            'user_id' => $user->id,
            'hospital_id' => $cart->hospital_id,
            'order_id' => $order_id,
            'doctor_id' => $cart->doctor_id,
            'type' => $cart->type,
            'booking_date' => $cart->booking_date,
            'time_slot' => $cart->time_slot,
            'total_amount' => $cart->price,
            'discount' => 0,
            'status' => 0,
            'payment_type' => $request->payment_option,
            'payment_status' => 'pending',
            'appointment_for' => $request->appointment_for ?? 'self',
            'pa_name' => $request->full_name,
            'father_name' => $request->father_name,
            'gender' => $request->gender,
            'age' => $request->age,
            'contact_no' => $request->mobile,
            'email' => $request->email,
        ];

        $order = Order::create($orderData);

        Transaction::create([
            'hospital_id' => $order->hospital_id,
            'user_id' => $order->user_id,
            'order_id' => $order->order_id,
            'debit' => 0,
            'credit' => $cart->price,
            'amount' => $cart->price,
            'gst' => 0,
            'type' => $request->payment_option,
            'remark' => 'Appointment booking',
            'date' => now()->format('Y-m-d'),
            'status' => 0,
        ]);

        $cart->delete();

        $response = [
            'status' => true,
            'data' => [
                'message' => $request->payment_option === 'online'
                    ? 'Order created successfully. Proceed to payment.'
                    : 'Appointment booked. Pay at hospital.',
                'order_id' => $order->id,
                'order_number' => $order->order_id,
                'amount' => $order->total_amount,
                'payment_status' => 'pending',
            ]
        ];

        if ($request->payment_option === 'online') {
            $response['data']['payment_redirect'] = route('payment.gateway', ['order_id' => $order->order_id]);
        }

        return response()->json($response, 201);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'data' => [
                'message' => 'Order processing failed',
                'error' => app()->isProduction() ? 'Something went wrong.' : $e->getMessage()
            ]
        ], 500);
    }
}
/**
 * @OA\Get(
 *     path="/api/user/get-user-orders",
 *     summary="Get all orders of the authenticated user",
 *     tags={"User"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="Orders fetched successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=true),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="message", type="string", example="Orders fetched successfully"),
 *                 @OA\Property(property="orders", type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         @OA\Property(property="order_id", type="string", example="ORD123456"),
 *                         @OA\Property(property="doctor_name", type="string", example="Dr. John Doe"),
 *                         @OA\Property(property="hospital_name", type="string", example="City Hospital"),
 *                         @OA\Property(property="booking_date", type="string", format="date", example="2025-05-20"),
 *                         @OA\Property(property="status", type="integer", example=1),
 *                         @OA\Property(property="total_amount", type="number", example=100),
 *                         @OA\Property(property="payment_status", type="string", example="pending"),
 *                         @OA\Property(property="payment_type", type="string", example="online")
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No orders found for this user",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=false),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="message", type="string", example="No orders found for this user"),
 *                 @OA\Property(property="orders", type="array", example=[])
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Order processing failed",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=false),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="message", type="string", example="Order processing failed"),
 *                 @OA\Property(property="error", type="string", example="Error message here")
 *             )
 *         )
 *     )
 * )
 */
public function getUserOrders(Request $request)
{
    try {
        // Get the authenticated user
        $user = $request->user();

        // Fetch orders along with hospital and doctor info
        $orders = Order::getOrdersWithUsers($user->id);

        if ($orders->isEmpty()) {
            return response()->json([
                'status' => false,
                'data' => [
                    'message' => 'No orders found for this user',
                    'orders' => []
                ]
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => [
                'message' => 'Orders fetched successfully',
                'orders' => $orders,
            ]
        ], 200);
           
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'data' => [
                'message' => 'Order processing failed',
                'error' => app()->isProduction() ? 'Something went wrong.' : $e->getMessage()
            ]
        ], 500);
    }
}
protected function generateUniqueOrderId()
{
    do {
        $orderId = 'ORD' . now()->format('Ymd') . strtoupper(Str::random(5));
    } while (Order::where('order_id', $orderId)->exists());

    return $orderId;
}
//end tag
    
}
