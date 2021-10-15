<?php

namespace App\Policies;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoriaPolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function viewAny(User $user)
  {
    return $user->rol !== 0
      ? $this->allow()
      : $this->deny('Sin acceso');
  }

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Categoria  $categoria
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function view(User $user, Categoria $categoria)
  {
    return $user->rol === 3
      ? $this->allow()
      : $this->deny('Sin acceso');
  }

  /**
   * Determine whether the user can create models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function create(User $user)
  {
    return $user->rol === 3
      ? $this->allow()
      : $this->deny('Sin acceso');
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Categoria  $categoria
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function update(User $user, Categoria $categoria)
  {
    return $user->rol === 3
      ? $this->allow()
      : $this->deny('Sin acceso');
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Categoria  $categoria
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function delete(User $user, Categoria $categoria)
  {
    return $user->rol === 3
      ? $this->allow()
      : $this->deny('Sin acceso');
  }

  /**
   * Determine whether the user can restore the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Categoria  $categoria
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function restore(User $user, Categoria $categoria)
  {
    //
  }

  /**
   * Determine whether the user can permanently delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Categoria  $categoria
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function forceDelete(User $user, Categoria $categoria)
  {
    //
  }
}
