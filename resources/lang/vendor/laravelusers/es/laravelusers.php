<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel Users Blades Language Lines
    |--------------------------------------------------------------------------
    */

    'showing-all-users'     => 'Showing All Users',
    'users-menu-alt'        => 'Show Users Management Menu',
    'create-new-user'       => 'Create New User',
    'show-deleted-users'    => 'Show Deleted User',
    'editing-user'          => 'Editing User :name',
    'showing-user'          => 'Showing User :name',
    'showing-user-title'    => ':name\'s Information',

    'users-table' => [
        'caption'   => '{1} :userscount user total|[2,*] :userscount total de usuarios',
        'id'        => 'ID',
        'name'      => 'Nombre',
        'email'     => 'Email',
        'role'      => 'Rol',
        'created'   => 'Creado',
        'updated'   => 'Actualizado',
        'actions'   => 'Acciones',
        'updated'   => 'Actualizado',
    ],

    'buttons' => [
        'create-new'    => '<span class="hidden-xs hidden-sm">Nuevo usuario</span>',
        'delete'        => '<i class="far fa-trash-alt fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span><span class="hidden-xs hidden-sm hidden-md"> Usuario</span>',
        'show'          => '<i class="fas fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Mostrar</span><span class="hidden-xs hidden-sm hidden-md"> Usuario</span>',
        'edit'          => '<i class="fas fa-pencil-alt fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Editar</span><span class="hidden-xs hidden-sm hidden-md"> Usuario</span>',
        'back-to-users' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">Usuarios</span>',
        'back-to-user'  => 'Regresar  <span class="hidden-xs">al usuario</span>',
        'delete-user'   => '<i class="far fa-trash-alt fa-fw" aria-hidden="true"></i>  <span class="hidden-xs">Eliminar</span><span class="hidden-xs"> usuario</span>',
        'edit-user'     => '<i class="fas fa-pencil-alt fa-fw" aria-hidden="true"></i> <span class="hidden-xs">Editar</span><span class="hidden-xs"> usuario</span>',
    ],

    'tooltips' => [
        'delete'        => 'Delete',
        'show'          => 'Show',
        'edit'          => 'Edit',
        'create-new'    => 'Create New User',
        'back-user'     => 'Back to user',
        'back-users'    => 'Back to users',
        'email-user'    => 'Email :user',
        'submit-search' => 'Submit Users Search',
        'clear-search'  => 'Clear Search Results',
    ],

    'messages' => [
        'userNameTaken'          => 'Username is taken',
        'userNameRequired'       => 'Username is required',
        'userNameInvalid'        => 'Username is invalid',
        'fNameRequired'          => 'First Name is required',
        'lNameRequired'          => 'Last Name is required',
        'emailRequired'          => 'Email is required',
        'emailInvalid'           => 'Email is invalid',
        'passwordRequired'       => 'Password is required',
        'PasswordMin'            => 'Password needs to have at least 6 characters',
        'PasswordMax'            => 'Password maximum length is 20 characters',
        'captchaRequire'         => 'Captcha is required',
        'CaptchaWrong'           => 'Wrong captcha, please try again.',
        'roleRequired'           => 'User role is required.',
        'user-creation-success'  => 'Successfully created user!',
        'update-user-success'    => 'Successfully updated user!',
        'delete-success'         => 'Successfully deleted the user!',
        'cannot-delete-yourself' => 'You cannot delete yourself!',
    ],

    'show-user' => [
        'id'                => 'ID',
        'name'              => 'Nombre de usuario',
        'email'             => '<span class="hidden-xs">Correo </span>',
        'role'              => 'Rol',
        'created'           => 'Creado <span class="hidden-xs">el</span>',
        'updated'           => 'Actualizado <span class="hidden-xs">el</span>',
        'labelRole'         => 'Rol',
        'labelAccessLevel'  => '<span class="hidden-xs">User</span> Access Level|<span class="hidden-xs">User</span> Access Levels',
    ],

    'search'  => [
        'title'         => 'Showing Search Results',
        'found-footer'  => ' Record(s) found',
        'no-results'    => 'No Results',
    ],
];
