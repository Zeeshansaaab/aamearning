<?php

use Intervention\Image\Facades\Image;

function getUserId(){
    $user = \App\Models\User::select('uuid')->orderby('id','DESC')->first();
    if($user){
        $id = explode('AAM',$user->uuid)[1]; 
        if( $id > 99999){
            return "AAM".$id+1;
        }
        return "AAM".sprintf('%05u', $id+1);
    }
    return "AAM".sprintf('%05u', 1);
}
/**
 * Get logged in user role
 * @return object
 */
function getRole($user)
{
    return $user && $user->roles ? $user->roles[0] : NULL;
}

/**
 * Get role permissions
 * @return object
 */
function getPermissionsName($role)
{
    return $role->permissions()->pluck('name');
}

function flash($message, $style = 'info')
{
    session()->flash('flash.banner', $message);
    session()->flash('flash.bannerStyle', $style);
}

function getTrx($length = 12)
{
    $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function makeDirectory($path)
{
    if (file_exists($path)) return true;
    return mkdir($path, 0755, true);
}

function removeFile($path)
{
    return file_exists($path) && is_file($path) ? @unlink($path) : false;
}

function uploadImage($file, $location, $size = null, $old = null, $thumb = null)
{
    $location = 'storage/' . $location;
    $path = makeDirectory($location);
    if (!$path) throw new Exception('File could not been created.');
    if (!empty($old)) {
        removeFile($location . '/' . $old);
        removeFile($location . '/thumb_' . $old);
    }


    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();


    $image = Image::make($file);


    if (!empty($size)) {
        $size = explode('x', strtolower($size));
        $image->resize($size[0], $size[1]);
    }
    $image->save($location . '/' . $filename);

    if (!empty($thumb)) {
        $thumb = explode('x', $thumb);
        Image::make($file)->resize($thumb[0], $thumb[1])->save($location . '/thumb_' . $filename);
    }
    return $filename;
}

function imagePath()
{
    $data['gateway'] = [
        'path' => 'assets/images/gateway',
        'size' => '800x800',
    ];
    $data['image'] = [
        'default' => 'assets/images/default.png',
    ];
    $data['verify'] = [
        'withdraw'=>[
            'path'=>'assets/images/verify/withdraw'
        ],
        'deposit'=>[
            'path'=>'assets/images/verify/deposit'
        ]
    ];
    $data['withdraw'] = [
        'method' => [
            'path' => 'assets/images/withdraw/method',
            'size' => '800x800',
        ]
    ];
    $data['ticket'] = [
        'path' => 'assets/images/support',
    ];
    $data['language'] = [
        'path' => 'assets/images/lang',
        'size' => '64x64'
    ];
    $data['logoIcon'] = [
        'path' => 'assets/images/logoIcon',
    ];
    $data['favicon'] = [
        'size' => '128x128',
    ];
    $data['plugin'] = [
        'path' => 'assets/images/plugin',
    ];
    $data['seo'] = [
        'path' => 'assets/images/seo',
        'size' => '600x315'
    ];
    $data['blogimage'] = [
        'path' => 'assets/images/frontend/blog',
        'size' => '600x315'
    ];
    return $data;
}

function getImage($image, $clean = '')
{
    return file_exists($image) && is_file($image) ? asset($image) . $clean : asset(imagePath()['image']['default']);
}
?>