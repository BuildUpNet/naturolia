<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\CodCharge;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->get(); 
        return view('Admin.admins', compact('admins'));
    }

    public function showSettings()
    {
      
        $admin = Auth::user(); 
        return view('Admin.admin-profile', compact('admin')); 
    }

  public function updateProfile(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        'phone' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:255',
        'zipcode' => 'nullable|string|max:10',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $admin = Auth::user();

   
    if ($request->hasFile('profile_image')) {
     
        if ($admin->profile_image) {
            
            $oldImagePath = public_path('profile_images/' . $admin->profile_image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); 
            }
        }

       
        $image = $request->file('profile_image');
        $imageExtension = $image->getClientOriginalExtension();
        $imageName = 'profile_' . time() . '.' . $imageExtension;

       
        $image->move(public_path('profile_images'), $imageName);

       
        $admin->profile_image = 'profile_images/' . $imageName;
    }

  
    $admin->name = $request->name;
    $admin->email = $request->email;
    $admin->phone = $request->phone;
    $admin->city = $request->city;
    $admin->address = $request->address;
    $admin->zipcode = $request->zipcode;

    $admin->save();

    return back()->with('success', 'Profile updated successfully.');
}

    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required|string',
        'new_password' => 'required|string|min:8|confirmed',
    ]);

    $admin = Auth::user();

  
    if (!Hash::check($request->current_password, $admin->password)) {
        return back()->withErrors(['current_password' => 'The current password is incorrect.']);
    }

   
    $admin->password = Hash::make($request->new_password);
    $admin->save();

  
    return redirect()->route('home')->with('success', 'Password updated successfully.');
}
public function updateCodCharge(Request $request)
{
    $request->validate([
        'cod_charge' => 'required|numeric|min:0',
    ]);

    CodCharge::updateOrCreate(
        ['id' => 1],
        ['amount' => $request->cod_charge]
    );

    return back()->with('success', 'COD charge updated successfully!');
}

}
