<?php



namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $_id = Auth::id();
        $row = User::where('_id', $_id)->first();
        return view('profile',compact('row'))->with ('user', auth()->user());
    }

    /**
     * Update the specified resource in storage.
     *  
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    protected function update_avatar(array $data)
    {
        if(request()->has('avatar')){
            
            $avataruploaded = request()->file('avatar');
            $avatarname = time() . '.' . $avataruploaded->getClientOriginalExtension();
            $avatarpath = public_path('/images/avatars/');
            $avataruploaded->move($avatarpath, $avatarname);
            return User::update_avatar([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'avatar' => '/images/avatars/' . $avatarname,
            ]);
        }
        return User::update_avatar([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar' => '/images/avatars/default.png',
        ]);

        // //Handle the user upload of avatar
        // if($request->hasFile('avatar')){
        //     $avatar = $request->file('avatar');
        //     $filename=time() . '.' . $avatar->getClientOriginalExtension();
        //     Image::make($avatar)->resize(300, 300)->save(public_path('/images/avatars/' . $filename));

        //     $user = User::find(Auth::id());
        //     $user->avatar = $filename;
        //     $user->save();
        // }

        // return view('profile', array ('user' => Auth::user()) );
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|max:50',
            'email' => 'required|email|max:50',
            'password' => 'nullable|confirmed|max:50',
            'avatar' => ['sometimes', 'image', 'mimes:jpg,jpeg,bmp.svg.png', 'max:5000']
        ]);

        $id = Auth::id();
        $row = User::findOrFail($id);
        $any = User::where([['email', '=', $request->email], ['_id', '<>', $id]])->first();

        if ($row != null && $any === null) {
            if (!empty($request->password)) {
                
                $row->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'avatar' => $request->avatar,
                ]);
                $request->session()->flash('alert-success', 'Data berhasil diperbarui dengan perubahan password!');
            } else {
                $avataruploaded = request()->file('avatar');
                $avatarname = time() . '.' . $avataruploaded->getClientOriginalExtension();
                $avatarpath = public_path('/images/avatars/');
                $avataruploaded->move($avatarpath, $avatarname);
                $row->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'avatar' => '/images/avatars/' . $avatarname,
                ]);
                $request->session()->flash('alert-success', 'Data berhasil diperbarui tanpa perubahan password!');
            }
        } else {
            $request->session()->flash('alert-warning', 'Data gagal diperbarui!');
        }

        return redirect('/dashboard/profile');
    }

}
