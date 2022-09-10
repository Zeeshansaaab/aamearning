<?php

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

?>