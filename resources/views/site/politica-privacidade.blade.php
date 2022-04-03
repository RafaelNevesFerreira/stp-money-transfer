@extends("layouts.app")
@section('content')
    <!-- Page Header
                                                                                                                        ============================================= -->
    <div class="page-header page-header-text-light bg-dark">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1>Elements 2</h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
                        <li><a href="http://demo.harnishdesign.net/html/payyed/index.html">Home</a></li>
                        <li class="active">Elements 2</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header end -->

    <!-- Content
                                                                                                                      ============================================= -->
    <div id="content">
        <div class="container">
            <div class="bg-white shadow-md rounded p-4 mb-4">
                <!-- Highlights      ============================================= -->
                <h1 class="text-center mt-5 mb-4">Política de privacidade</h1>
                <br>
                <br>
                <div class="row">
                    <div class="col-md-8 mx-auto">

                        <h2>SEÇÃO 1 - INFORMAÇÕES GERAIS</h2>
                        <p>A presente Política de Privacidade contém informações sobre coleta, uso, armazenamento,
                            tratamento e proteção dos dados pessoais dos usuários e visitantes do site
                            {{ env('APP_NAME') }},
                            com a finalidade de demonstrar absoluta transparência quanto ao assunto e esclarecer a todos
                            interessados
                            sobre os tipos de dados que são coletados, os motivos da coleta e a forma como os usuários podem
                            gerenciar
                            ou excluir as suas informações pessoais.
                            Esta Política de Privacidade aplica-se a todos os usuários e visitantes site
                            {{ env('APP_NAME') }} e
                            integra os Termos e Condições Gerais de Uso do site {{ env('APP_NAME') }}.
                        </p>
                    </div>
                    <div class="col-md-8 mx-auto mt-5">

                        <h2>SEÇÃO 2 - COMO RECOLHEMOS OS DADOS PESSOAIS DO USUÁRIO E DO VISITANTE?</h2>
                        <ol>
                            <p>
                                Os dados pessoais do usuário e visitante são recolhidos pela plataforma da seguinte forma:
                            </p>
                            <li>
                                Quando o usuário cria uma conta/perfil na plataforma {{ env('APP_NAME') }}: esses dados
                                são
                                os dados de
                                identificação básicos, como: e-mail, nome completo, país de residência ,morada, telemóvel
                                . A partir deles, podemos identificar o usuário e o visitante, além de garantir
                                uma maior segurança e bem-estar às suas necessidade.
                                Ficam cientes os usuários e visitantes de que seu perfil na plataforma
                                {{ env('APP_NAME') }}
                                não estará acessível
                                a nenhum dos demais usuários e visitantes da plataforma
                                {{ env('APP_NAME') }}.
                            </li>
                        </ol>
                    </div>

                    <div class="col-md-8 mx-auto mt-5">

                        <h2>SEÇÃO 3 - PARA QUE FINALIDADES UTILIZAMOS OS DADOS PESSOAIS DO USUÁRIO E VISITANTE?</h2>
                        <ol>
                            <p>
                                Os dados pessoais do usuário e do visitante coletados e armazenados pela plataforma
                                {{ env('APP_NAME') }} tem por finalidade:
                            </p>
                            <li>
                                Bem-estar do usuário e visitante: aprimorar o produto e/ou serviço oferecido, facilitar,
                                agilizar e cumprir os
                                compromissos estabelecidos entre o us
                                empresa, melhorar a experiência dos usuários e fornecer funcionalidades específicas a
                                depender das características
                                básicas do usuário.
                            </li>

                            <li>
                                Melhorias da plataforma: compreender como o usuário utiliza os serviços da plataforma,
                                para ajudar no desenvolvimento de negócios e técnicas.
                            </li>

                            <li>
                                Comercial: os dados são usados para personalizar o conteúdo oferecido e gerar
                                subsídio à plataforma para a melhora da qualidade no funcionamento dos serviços.
                            </li>

                            <li>
                                Previsão do perfil do usuário: tratamento automatizados de dados pessoais para avaliar o
                                uso na plataforma.
                            </li>

                            <li>
                                Dados de cadastro: para permitir o acesso do usuário a determinados conteúdos da
                                plataforma, exclusivo para usuários cadastrados
                            </li>
                        </ol>

                        <p>
                            O tratamento de dados pessoais para finalidades não previstas nesta Política de Privacidade
                            somente ocorrerá mediante comunicação prévia ao usuário,
                            de modo que os direitos e obrigações aqui previstos permanecem aplicáveis.
                        </p>
                    </div>

                    <div class="col-md-8 mx-auto mt-5">

                        <h2>SEÇÃO 4 -SEGURANÇA DOS DADOS PESSOAIS ARMAZENADOS</h2>
                        <p>
                            A plataforma se compromete a aplicar as medidas técnicas e organizativas aptas a proteger os
                            dados pessoais de acessos não autorizados e de situações de destruição, perda, alteração,
                            comunicação ou difusão de tais dados.
                        </p>
                        <p>
                            Os dados relativas a cartões de crédito são criptografados usando a tecnologia "secure socket
                            layer" (SSL) que garante a transmissão de dados de forma segura e confidencial, de modo que a
                            transmissão dos dados entre o servidor e o usuário ocorre de maneira cifrada e encriptada.
                        </p>
                        <p>
                            A plataforma não se exime de responsabilidade por culpa exclusiva de terceiro, como em caso de
                            ataque de hackers ou crackers, ou culpa exclusiva do usuário, como no caso em que ele mesmo
                            transfere seus dados a terceiros. O site se compromete a comunicar o usuário em caso de alguma
                            violação de segurança dos seus dados pessoais.
                        </p>
                        <p>
                            Os dados pessoais armazenados são tratados com confidencialidade, dentro dos limites legais. No
                            entanto, podemos divulgar suas informações pessoais caso sejamos obrigados pela lei para fazê-lo
                            ou se você violar nossos Termos de Serviço.
                        </p>
                    </div>

                    <div class="col-md-8 mx-auto mt-5">

                        <h2>SEÇÃO 5 - COMPARTILHAMENTO DOS DADOS</h2>
                        <p>
                            O compartilhamento de dados do usuário ocorre apenas com os dados referentes os envios de
                            dinheiro
                            realizadas pelo próprio usuário, tais ações são compartilhadas apenas com os responsaveis pela
                            entrega do dinheiro.
                        </p>
                        <p>
                            Os dados do perfil do usuário não são compartilhados publicamente em sistemas de busca nem
                            dentro da
                            plataforma para outros usuarios.
                        </p>

                    </div>


                    <div class="col-md-8 mx-auto mt-5">

                        <h2>SEÇÃO 5 - COMPARTILHAMENTO DOS DADOS</h2>
                        <p>
                            O compartilhamento de dados do usuário ocorre apenas com os dados referentes os envios de
                            dinheiro
                            realizadas pelo próprio usuário, tais ações são compartilhadas apenas com os responsaveis pela
                            entrega do dinheiro.
                        </p>
                        <p>
                            Os dados do perfil do usuário não são compartilhados publicamente em sistemas de busca nem
                            dentro da
                            plataforma para outros usuarios.
                        </p>

                    </div>


                </div>


                <!-- Highlights End-->

            </div>
        </div>
    </div>
    <!-- Content end -->
@endsection
