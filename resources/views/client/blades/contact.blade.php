@extends('client.core.client')
@section('content')
    <section class="contact mb-0 mt-4">
        @if (isset($contact) && $contact->name_section != null)
            <div class="d-flex justify-content-start gap-2 align-items-start flex-nowrap">
                <span class="firula-contact mt-2"></span>
                <div class="description">
                    <h3 class="montserrat-bold font-30 mb-0 title-blue">{{$contact->name_section}}</h3>
                    <p class="mb-0 text-color montserrat-regular font-15">{{$contact->text}}</p>
                </div>
            </div>
        @endif
        <div class="container py-5">
            <!-- Filiais -->
            <div class="row g-3 mb-4">
                @if (isset($contact) && $contact->name_one != null ||
                isset($contact) && $contact->address_one != null || isset($contact) && $contact->opening_hours_one != null
                || isset($contact) && $contact->phone_one != null) 
                    <!-- Filial 1 -->
                    <div class="col-md-4">
                        <div class="border rounded p-3 h-100 bg-box-contact">
                            @if (isset($contact) && $contact->name_one != null)                            
                                <div class="d-flex gap-2 justify-content-start align-items-center">
                                    <svg width="31" height="38" viewBox="0 0 31 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.5 0C6.94326 0 0 7.125 0 15.9057C0 32.4493 14.8784 37.8507 15.0239 37.9186C15.1826 37.9729 15.3281 38 15.5 38C15.6587 38 15.8174 37.9729 15.9629 37.9186C16.1216 37.8643 31 32.4629 31 15.9057C31 7.125 24.0435 0 15.5 0ZM15.5 24.2521C10.9637 24.2521 7.28712 20.4657 7.28712 15.8379C7.28712 11.1829 10.977 7.41 15.5 7.41C20.023 7.41 23.6997 11.1964 23.6997 15.8379C23.6997 20.4657 20.023 24.2521 15.5 24.2521Z" fill="#2F368B"/>
                                    </svg>
                                    <h6 class="montserrat-semiBold font-18 mb-2 title-blue">
                                        {{$contact->name_one}}
                                    </h6>
                                </div>
                            @endif
                            @if (isset($contact) && $contact->address_one != null)                            
                                <div class="my-2 text-address">
                                    {!!$contact->address_one!!}
                                </div>
                            @endif
                            <div class="d-flex justify-content-between flex-wrap">
                                @if (isset($contact) && $contact->opening_hours_one != null)  
                                    <p class="mb-1 text-color montserrat-regular font-14 small col-12 col-lg-5">{{$contact->opening_hours_one}}</p>
                                @endif
                                @if (isset($contact) && $contact->phone_one != null)                                
                                    <p class="mb-0 text-color montserrat-regular font-14 small">
                                        <svg width="13" height="22" viewBox="0 0 13 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 17H2V3H11M6.5 21C6.10218 21 5.72064 20.842 5.43934 20.5607C5.15804 20.2794 5 19.8978 5 19.5C5 19.1022 5.15804 18.7206 5.43934 18.4393C5.72064 18.158 6.10218 18 6.5 18C6.89782 18 7.27936 18.158 7.56066 18.4393C7.84196 18.7206 8 19.1022 8 19.5C8 19.8978 7.84196 20.2794 7.56066 20.5607C7.27936 20.842 6.89782 21 6.5 21ZM10.5 0H2.5C1.83696 0 1.20107 0.263392 0.732233 0.732233C0.263392 1.20107 0 1.83696 0 2.5V19.5C0 20.163 0.263392 20.7989 0.732233 21.2678C1.20107 21.7366 1.83696 22 2.5 22H10.5C11.163 22 11.7989 21.7366 12.2678 21.2678C12.7366 20.7989 13 20.163 13 19.5V2.5C13 1.83696 12.7366 1.20107 12.2678 0.732233C11.7989 0.263392 11.163 0 10.5 0Z" fill="#2F368B"/>
                                        </svg>
            
                                        {{$contact->phone_one}}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($contact) && $contact->name_two != null ||
                isset($contact) && $contact->address_two != null || isset($contact) && $contact->opening_hours_two != null
                || isset($contact) && $contact->phone_two != null) 
                    <!-- Filial 2 -->
                    <div class="col-md-4">
                        <div class="border rounded p-3 h-100 bg-box-contact">
                            @if (isset($contact) && $contact->name_two != null)                            
                                <div class="d-flex gap-2 justify-content-start align-items-center">
                                    <svg width="31" height="38" viewBox="0 0 31 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.5 0C6.94326 0 0 7.125 0 15.9057C0 32.4493 14.8784 37.8507 15.0239 37.9186C15.1826 37.9729 15.3281 38 15.5 38C15.6587 38 15.8174 37.9729 15.9629 37.9186C16.1216 37.8643 31 32.4629 31 15.9057C31 7.125 24.0435 0 15.5 0ZM15.5 24.2521C10.9637 24.2521 7.28712 20.4657 7.28712 15.8379C7.28712 11.1829 10.977 7.41 15.5 7.41C20.023 7.41 23.6997 11.1964 23.6997 15.8379C23.6997 20.4657 20.023 24.2521 15.5 24.2521Z" fill="#2F368B"/>
                                    </svg>
                                    <h6 class="montserrat-semiBold font-18 mb-2 title-blue">
                                        {{$contact->name_two}}
                                    </h6>
                                </div>
                            @endif
                            @if (isset($contact) && $contact->address_two != null)                            
                                <div class="my-2 text-address">
                                    {!!$contact->address_two!!}
                                </div>
                            @endif
                            <div class="d-flex justify-content-between flex-wrap">
                                @if (isset($contact) && $contact->opening_hours_one != null)  
                                    <p class="mb-1 text-color montserrat-regular font-14 small col-12 col-lg-5">{{$contact->opening_hours_two}}</p>
                                @endif
                                @if (isset($contact) && $contact->phone_two != null)                                
                                    <p class="mb-0 text-color montserrat-regular font-14 small">
                                        <svg width="13" height="22" viewBox="0 0 13 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 17H2V3H11M6.5 21C6.10218 21 5.72064 20.842 5.43934 20.5607C5.15804 20.2794 5 19.8978 5 19.5C5 19.1022 5.15804 18.7206 5.43934 18.4393C5.72064 18.158 6.10218 18 6.5 18C6.89782 18 7.27936 18.158 7.56066 18.4393C7.84196 18.7206 8 19.1022 8 19.5C8 19.8978 7.84196 20.2794 7.56066 20.5607C7.27936 20.842 6.89782 21 6.5 21ZM10.5 0H2.5C1.83696 0 1.20107 0.263392 0.732233 0.732233C0.263392 1.20107 0 1.83696 0 2.5V19.5C0 20.163 0.263392 20.7989 0.732233 21.2678C1.20107 21.7366 1.83696 22 2.5 22H10.5C11.163 22 11.7989 21.7366 12.2678 21.2678C12.7366 20.7989 13 20.163 13 19.5V2.5C13 1.83696 12.7366 1.20107 12.2678 0.732233C11.7989 0.263392 11.163 0 10.5 0Z" fill="#2F368B"/>
                                        </svg>
            
                                        {{$contact->phone_two}}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($contact) && $contact->name_three != null ||
                isset($contact) && $contact->address_three != null || isset($contact) && $contact->opening_hours_three != null
                || isset($contact) && $contact->phone_three != null) 
                    <!-- Filial 3 -->
                    <div class="col-md-4">
                        <div class="border rounded p-3 h-100 bg-box-contact">
                            @if (isset($contact) && $contact->name_three != null)                            
                                <div class="d-flex gap-2 justify-content-start align-items-center">
                                    <svg width="31" height="38" viewBox="0 0 31 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.5 0C6.94326 0 0 7.125 0 15.9057C0 32.4493 14.8784 37.8507 15.0239 37.9186C15.1826 37.9729 15.3281 38 15.5 38C15.6587 38 15.8174 37.9729 15.9629 37.9186C16.1216 37.8643 31 32.4629 31 15.9057C31 7.125 24.0435 0 15.5 0ZM15.5 24.2521C10.9637 24.2521 7.28712 20.4657 7.28712 15.8379C7.28712 11.1829 10.977 7.41 15.5 7.41C20.023 7.41 23.6997 11.1964 23.6997 15.8379C23.6997 20.4657 20.023 24.2521 15.5 24.2521Z" fill="#2F368B"/>
                                    </svg>
                                    <h6 class="montserrat-semiBold font-18 mb-2 title-blue">
                                        {{$contact->name_three}}
                                    </h6>
                                </div>
                            @endif
                            @if (isset($contact) && $contact->address_three != null)                            
                                <div class="my-2 text-address">
                                    {!!$contact->address_three!!}
                                </div>
                            @endif
                            <div class="d-flex justify-content-between flex-wrap">
                                @if (isset($contact) && $contact->opening_hours_one != null)  
                                    <p class="mb-1 text-color montserrat-regular font-14 small col-12 col-lg-5">{{$contact->opening_hours_three}}</p>
                                @endif
                                @if (isset($contact) && $contact->phone_three != null)                                
                                    <p class="mb-0 text-color montserrat-regular font-14 small">
                                        <svg width="13" height="22" viewBox="0 0 13 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 17H2V3H11M6.5 21C6.10218 21 5.72064 20.842 5.43934 20.5607C5.15804 20.2794 5 19.8978 5 19.5C5 19.1022 5.15804 18.7206 5.43934 18.4393C5.72064 18.158 6.10218 18 6.5 18C6.89782 18 7.27936 18.158 7.56066 18.4393C7.84196 18.7206 8 19.1022 8 19.5C8 19.8978 7.84196 20.2794 7.56066 20.5607C7.27936 20.842 6.89782 21 6.5 21ZM10.5 0H2.5C1.83696 0 1.20107 0.263392 0.732233 0.732233C0.263392 1.20107 0 1.83696 0 2.5V19.5C0 20.163 0.263392 20.7989 0.732233 21.2678C1.20107 21.7366 1.83696 22 2.5 22H10.5C11.163 22 11.7989 21.7366 12.2678 21.2678C12.7366 20.7989 13 20.163 13 19.5V2.5C13 1.83696 12.7366 1.20107 12.2678 0.732233C11.7989 0.263392 11.163 0 10.5 0Z" fill="#2F368B"/>
                                        </svg>
            
                                        {{$contact->phone_three}}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <!-- Formulário e Mapa -->
            <div class="row g-4 mt-4">
                <div class="col-lg-8">
                    <form id="contactForm">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <input type="text" required id="nome" name="name" class="montserrat-regular font-15 text-color form-control" placeholder="Nome Completo">
                            </div>
                            <div class="col-md-6">
                                <input type="email" required id="email" name="email" class="montserrat-regular font-15 text-color form-control" placeholder="E-mail">
                            </div>
                            <div class="col-md-6">
                                <input type="text" required id="phone" name="phone" class="montserrat-regular font-15 text-color form-control" placeholder="Whatsapp para contato">
                            </div>
                            <div class="col-md-12">
                                <input type="text" required id="subject" name="subject" class="montserrat-regular font-15 text-color form-control" placeholder="Assunto">
                            </div>
                            <div class="col-md-12">
                                <textarea id="text" required name="text" class="form-control montserrat-regular font-15 text-color" rows="4" placeholder="Digite aqui...."></textarea>
                            </div>
                            <div class="col-12 d-flex align-items-center flex-wrap">
                                <div class="form-check me-3">
                                    <input class="form-check-input" required id="term_privacy" name="term_privacy" type="checkbox" value="1">
                                    <label class="form-check-label small montserrat-regular font-14 text-color" for="privacyCheck">
                                        Aceito os termos descritos na Política de Privacidade
                                    </label>
                                </div>
                                <button type="submit" class="montserrat-semiBold font-15 btn background-red text-white rounded-3 ms-auto px-4">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
                @if (isset($contact->maps) && $contact->maps != null)                    
                    <div class="col-lg-4">
                        <div class="ratio ratio-1x1 rounded border overflow-hidden">
                            <iframe
                            src="{{$contact->maps}}"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy">
                            </iframe>                        
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#contactForm').on('submit', function(e) {
            e.preventDefault();

            const formData = $(this).serialize();

            $.ajax({
                url: '{{ route("send-contact") }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Sucesso!',
                            text: response.message,
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                    $('#contactForm')[0].reset();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessages = '';
                        for (let field in errors) {
                            errorMessages += errors[field][0] + '\n';
                        }

                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                title: 'Erro',
                                text: errorMessages,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    } else {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                title: 'Erro',
                                text: 'Ocorreu um erro ao enviar a mensagem. Por favor, tente novamente.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    }
                }
            });
        });
    });
</script>
@endsection