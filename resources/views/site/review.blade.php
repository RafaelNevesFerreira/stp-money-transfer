@extends('layouts.app')
@section('content')
    <!-- Conten  ============================================= -->
    <div id="content" class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-lg-7 col-xl-6 mx-auto">
                    <div class="bg-white shadow-sm rounded p-3 pt-sm-4 pb-sm-5 px-sm-5 mb-4">
                        <h3 class="text-5 fw-400 text-center mb-3 mb-sm-4">Deixe-nos um review</h3>
                        <hr class="mx-n3 mx-sm-n5 mb-4">
                        <form id="form-send-money" method="post" action="{{ route("review_submit") }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="name" required name="name">
                            </div>
                            <div class="mb-3">
                                <label for="country" class="form-label">País de residência</label>
                                <select id="country" class="form-control " required name="country">
                                    <option value="Portugal">Portugal</option>
                                    <option value="Angola">Angola</option>
                                    <option value="França">França</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Australia">Austrália</option>
                                    <option value="Austria">Áustria</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Bélgica">Bélgica</option>
                                    <option value="Brasil">Brasil</option>
                                    <option value="Bulgaria">Bulgária</option>
                                    <option value="Burkina Faso">Burkina Faso</option>
                                    <option value="Camarões">Camarões</option>
                                    <option value="Canada">Canadá</option>
                                    <option value="cabo Verde">cabo Verde</option>
                                    <option value="China">China</option>
                                    <option value="Colombia">Colômbia</option>
                                    <option value="Comoros">Comores</option>
                                    <option value="Congo">Congo</option>
                                    <option value="Cote D'Ivoire">Cote D'Ivoire</option>
                                    <option value="Cuba">Cuba</option>
                                    <option value="Ecuador">Equador</option>
                                    <option value="Guiné Equatorial">Guiné Equatorial</option>
                                    <option value="Finlândia">Finlândia</option>
                                    <option value="Gabão">Gabão</option>
                                    <option value="Alemanha">Alemanha</option>
                                    <option value="Guiné">Guiné</option>
                                    <option value="Guine-Bissau">Guine-bissau</option>
                                    <option value="Hong Kong">Hong Kong</option>
                                    <option value="Hungria">Hungria</option>
                                    <option value="Islândia">Islândia</option>
                                    <option value="India">Índia</option>
                                    <option value="Itália">Itália</option>
                                    <option value="Japão">Japão</option>
                                    <option value="Quênia">Quênia</option>
                                    <option value="Líbano">Líbano</option>
                                    <option value="Luxemburgo">Luxemburgo</option>
                                    <option value="Macau">Macau</option>
                                    <option value="Mali">Mali</option>
                                    <option value="Mexico">México</option>
                                    <option value="Monaco">Mônaco</option>
                                    <option value="Mongolia">Mongólia</option>
                                    <option value="Marrocos">Marrocos</option>
                                    <option value="Moçambique">Moçambique</option>
                                    <option value="Países Baixos">Países Baixos</option>
                                    <option value="Nova Zelândia">Nova Zelândia</option>
                                    <option value="Nigeria">Nigéria</option>
                                    <option value="Polônia">Polônia</option>
                                    <option value="Catar">Catar</option>
                                    <option value="Ruanda">Ruanda</option>
                                    <option value="Senegal">Senegal</option>
                                    <option value="Espanha">Espanha</option>
                                    <option value="Suíça">Suíça</option>
                                    <option value="Taiwan">Taiwan</option>
                                    <option value="Timor-Leste">Timor-Leste</option>
                                    <option value="Reino Unido">Reino Unido</option>
                                    <option value="Estados Unidos">Estados Unidos</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="review" class="form-label">Comentario</label>
                                <textarea class="form-control" maxlength="300" name="content" id="review" rows="5"></textarea>
                            </div>

                            <hr>
                            @if ($errors->any())
                                <div class='form-row row'>
                                    <div class='col-md-12 error form-group'>
                                        <div class='alert-danger alert'>
                                            @foreach ($errors->all() as $error)
                                                <p>{!! $error !!}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (session('message'))
                                <div class='form-row row'>
                                    <div class='col-md-12 error form-group'>
                                        <div class='alert-success alert'>
                                            <p>{{session("message")}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="d-grid"><button class="btn btn-primary">Enviar</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content end -->
@endsection
