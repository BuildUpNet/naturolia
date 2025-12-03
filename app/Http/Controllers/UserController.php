<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use Carbon\Carbon;


class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get();
        return view('Admin.users', compact('users'));
    }

 public function showProfile()
{
    $user = Auth::user();

  
    $orderCount = $user->orders()->count();

  
    $pendingOrderCount = $user->orders()->where('status', 'pending')->count();

  
    $addressTableCount = $user->addresses()->count(); 

    
    $userTableHasAddress = ($user->address || $user->city || $user->zipcode) ? 1 : 0;


    $totalAddressCount = $addressTableCount + $userTableHasAddress;

    $recentOrder = $user->orders()->latest('created_at')->first();

    // Define profile fields to check
    $fields = ['name', 'email', 'phone', 'address'];

    // Count filled fields
    $filled = collect($fields)->filter(fn($f) => !empty($user->$f))->count();

    // Calculate percentage
    $profileCompletion = round(($filled / count($fields)) * 100);
    
    return view('user-profile', compact(
        'user',
        'orderCount',
        'pendingOrderCount',
        'totalAddressCount',
        'recentOrder',
        'profileCompletion',
    ));
}


    public function AccountOrder()
    {
        $user = Auth::user();
      
    $orders = Order::where('user_id', $user->id)
        ->with('items.product')
        ->latest()
        ->paginate(3);
        return view('profile-orders', compact('user' , 'orders'));
    }

public function AccountAddress()
{
    $user = Auth::user(); 

    if (!$user) {
        return redirect()->route('login')->with('error', 'Please log in to view addresses.');
    }

   
    $userAddress = $user->only(['address', 'city', 'state', 'zipcode', 'name', 'phone']);

  
    $addresses = Address::where('user_id', $user->id)->get();

    // Fetch the default address if available
    $defaultAddress = $user->default_address_id ? Address::find($user->default_address_id) : null;

    return view('profile-addresses', compact('userAddress', 'addresses', 'defaultAddress'));
}




    public function AccountDetail()
    {
        $user = Auth::user();
        return view('profile-details', compact('user'));
    }
    
    public function addressedit($id)
{

    $address = Address::find($id);
    if (!$address) {
        return response()->json(['error' => 'Address not found'], 404);
    }
    return response()->json($address);


}

public function update(Request $request, $id)
{
    $request->validate([
        'receiver_name' => 'required|string|max:255',
        'address' => 'required|string',
        'pincode' => 'required|string|max:10',
        'city' => 'required|string|max:255',
        'state' => 'required|string|max:255',
    ]);

    $address = Address::findOrFail($id);

    // Update the address
    $address->update([
        'receiver_name' => $request->receiver_name,
        'address' => $request->address,
        'pincode' => $request->pincode,
        'city' => $request->city,
        'state' => $request->state,
    ]);

    return response()->json(['success' => true]);
}


public function destroy($id)
{
    $address = Address::findOrFail($id);
    $address->delete();

    return redirect()->route('account.address')->with('success', 'Address deleted successfully.');
}
public function updateUserAddress(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string',
        'city' => 'required|string|max:255',
        'zipcode' => 'required|string|max:20',
        'phone' => 'required|string|max:20',
    ]);

    $user = Auth::user();

    // Assuming your user model has these fields directly or in a related model
    $user->name = $request->name;
    $user->address = $request->address;
    $user->city = $request->city;
    $user->zipcode = $request->zipcode;
    $user->phone = $request->phone;

    $user->save();

    return redirect()->back()->with('success', 'Home address updated successfully.');
}

public function deleteUserAddress()
{
    $user = Auth::user();

   
    $user->address = null;
    $user->city = null;
    $user->zipcode = null;
    $user->phone = null;

    $user->save();

    return redirect()->back()->with('success', 'Home address deleted successfully.');
}
public function storeAddress(Request $request)
{
    $request->validate([
        'receiver_name' => 'required|string|max:255',
        'address'       => 'required|string',
        'pincode'       => 'required|string|max:10',
        'city'          => 'required|string|max:255',
        'state'         => 'required|string|max:255',
    ]);

    Address::create([
        'user_id'       => auth()->id(),
        'receiver_name' => $request->receiver_name,
        'address'       => $request->address,
        'pincode'       => $request->pincode,
        'city'          => $request->city,
        'state'         => $request->state,
    ]);

    return redirect()->route('account.address')->with('success', 'Address added successfully!');
}
 public function updateUserprofile(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'phone'    => 'nullable|string|max:20',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Update fields
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        // Update password only if filled
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('account.detail')->with('success', 'Profile updated successfully!');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'phone'    => 'nullable|string|max:15',
            'address'  => 'nullable|string|max:255',
            'city'     => 'nullable|string|max:255',
            'zipcode'  => 'nullable|string|max:10',
        ]);

        $user = Auth::user();
        $user->update($request->only('name', 'email', 'phone', 'address', 'city', 'zipcode'));

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }

    public function updateProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_image')) {
            $image      = $request->file('profile_image');
            $imageName  = time() . '.' . $image->getClientOriginalExtension();
            $directory  = public_path('userprofile');

            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            $image->move($directory, $imageName);

            // Remove old image if exists
            if ($user->profile_image && File::exists(public_path($user->profile_image))) {
                File::delete(public_path($user->profile_image));
            }

            $user->profile_image = 'userprofile/' . $imageName;
            $user->save();
        }

        return redirect()->route('profile.show')->with('success', 'Profile image updated successfully!');
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:active,inactive',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['status' => 'success', 'message' => 'User status updated successfully']);
    }
     public function showDeleteAccount()
    {
        $user = Auth::user();
        return view('inactive-account', compact('user'));
    }
      public function deactivateAccount(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'password' => 'required',
        ]);

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'The password does not match our records.']);
        }

$user->status = 'inactive';
$user->save();
Auth::logout();
        return redirect('/')->with('success', 'Your account has been temporarily deactivated.');
    }

    // Permanent Deletion
    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'password' => 'required',
        ]);

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'The password does not match our records.']);
        }

        Auth::logout();
        $user->delete();

        return redirect('/')->with('success', 'Your account has been permanently deleted.');
    }
 public function showReactivateFormByToken($token)
    {
        $user = \App\Models\User::where('reactivation_token', $token)
            ->where('reactivation_expires_at', '>', now())
            ->firstOrFail();

        return view('reactivate', compact('user', 'token'));
    }

    // Handle reactivation via token
    public function reactivateAccountByToken(Request $request, $token)
    {
        $user = \App\Models\User::where('reactivation_token', $token)
            ->where('reactivation_expires_at', '>', now())
            ->firstOrFail();

        $request->validate([
            'password' => 'required',
        ]);

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Incorrect password.']);
        }

        $user->status = 'active';
        $user->reactivation_token = null;
        $user->reactivation_expires_at = null;
        $user->save();

        return redirect()->route('home')->with('success', 'Your account has been reactivated. Please log in.');
    }
}
