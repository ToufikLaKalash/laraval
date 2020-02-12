@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Page d'administration</div>
                    <div class="card-body">
                        @if($admin == true)
                            @if(!isset($data))
                                <form action="{{ route('admin') }}" method="post">
                                    @csrf
                                    <select name="user">
                                        @foreach($userList as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit">Gérer</button>
                                </form>
                            @else
                                <a href="{{ route('admin') }}">Retour au choix de l'utilisateur</a>
                                <h1>Informations</h1>
                                @foreach(App\User::where('id', '=', $data['user'])->select('*')->get() as $info)
                                    <div id="infos">
                                <form action="{{ route('admin/modifself') }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <label for="name">Nom</label>
                                    <input type="text" name="name" value="{{$info['name']}}"><br>
                                    <label for="firstname">Prénom</label>
                                    <input type="text" name="firstname" value="{{$info['firstname']}}"><br>
                                    <label for="lastname">Nom de famille</label>
                                    <input type="text" name="lastname" value="{{$info['lastname']}}"><br>
                                    <label for="email">Email</label>
                                    <input type="email" name="email" value="{{$info['email']}}"><br>
                                    <label for="bio">Bio</label>
                                    <input type="text" name="bio" value="{{$info['bio']}}"><br>
                                    <label for="password">Mot de passe</label>
                                    <input type="password" name="password"><br>
									<input type="hidden" name="oldemail" value="{{$info['email']}}">
                                    <button type="submit" class="btn btn-success">Modifier</button>
                                </form>
                            </div>
                                @endforeach
                                <h1>Compétences</h1>
                                <div id="competences">
                                    @foreach(App\User::find($data['user'])->skills as $key => $skill)
                                            <p>Nom: {{ $skill->name }} | Niveau {{ $skill->pivot->level }}</p>
                                            <div id="modify">
                                                <form action="{{ route('admin/modify') }}" method="post">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="number" name="skillValue" min="1" max="5">
                                                    <input type="hidden" name="skillId" value="{{ $skill->id }}">
                                                    <input type="hidden" name="key" value="{{ $key }}">
                                                    <input type="hidden" value="{{ $data['user'] }}" name="userId">
                                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                                </form>
                                            </div>
                                            <div id="delete">
                                                <form action="{{ route('admin/delete') }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" value="{{ $skill->name }}" name="skillName">
                                                    <input type="hidden" value="{{ $key }}" name="key">
                                                    <input type="hidden" value="{{ $data['user'] }}" name="userId">
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                </form>
                                            </div>
                                        <br>
                                    @endforeach
                                    <div id="add">
                                        <form action="{{ route('admin/add') }}" method="post">
                                            @csrf
                                            @method('POST')
                                            <select name="skillId">
                                                @foreach(App\User::find($data['user'])->notSkills($data['user']) as $skill)
                                                    <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" value="{{ $data['user'] }}" name="userId">
                                            <button type="submit" class="btn btn-success">Ajouter</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                            <p><a href="{{ route('home') }}">Retourner à l'accueil</a></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
