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
            <div class="d-flex align-items-center justify-content-start flex-wrap mb-4">
                @if (isset($contact) && $contact->name_one != null ||
                isset($contact) && $contact->phone_one != null) 
                @if (isset($contact) && $contact->phone_one != null)                                
                        <div class="d-flex col-12 col-lg-3 gap-2 justify-content-center justify-content-lg-start align-items-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_38_3075)">
                            <path d="M4.21055 16.4814C6.65583 19.4489 9.61972 21.6911 13.0216 23.1435C14.2625 23.6735 15.4294 23.9499 16.5942 23.9966C16.6635 23.9966 16.7306 24 16.7977 24C17.8782 24 18.7779 23.6588 19.4705 22.9843C20.0528 22.4167 20.6295 21.8286 21.1822 21.2599L21.255 21.1837C21.669 20.7583 21.9135 20.2748 21.9795 19.7425C22.0784 18.9793 21.8191 18.2775 21.2084 17.6633C20.576 17.0252 19.9391 16.3905 19.3011 15.7592C19.2192 15.6773 19.1407 15.5965 19.0599 15.5146C18.8154 15.2644 18.5618 15.0085 18.274 14.7696C17.3482 14.0007 16.1404 14.0098 15.202 14.7901C15.0621 14.9061 14.937 15.0312 14.829 15.1393L14.7914 15.1768C14.3718 15.5965 13.9532 16.0185 13.5335 16.4371C13.4983 16.42 13.4664 16.4018 13.4312 16.3848C13.1366 16.2335 12.858 16.0902 12.6009 15.9275C11.2088 15.0369 9.91677 13.8278 8.64987 12.2353C8.1722 11.6358 7.80598 11.0591 7.53529 10.4791L7.83212 10.1845C8.23133 9.7909 8.6419 9.3837 9.03997 8.97307C10.0624 7.91638 10.0624 6.55372 9.03997 5.50504C8.33481 4.78048 7.60691 4.05819 6.90632 3.35867L6.29442 2.75015C5.97712 2.43282 5.60973 2.21443 5.20825 2.09839C4.60546 1.92322 3.70013 1.89706 2.81527 2.75356C2.60599 2.95716 2.40127 3.16419 2.19542 3.37347C1.88719 3.68739 1.59603 3.98542 1.28668 4.26409C0.404113 5.06485 -0.0383336 6.06921 0.00260347 7.17255C0.00260347 8.12458 0.15387 8.98679 0.485987 9.96497C1.25482 12.2365 2.47178 14.3625 4.2073 16.4701L4.21055 16.4814ZM2.27137 5.35258C2.61258 5.04433 2.92989 4.71788 3.24038 4.40281C3.436 4.20148 3.63391 4.00357 3.83408 3.80905C4.10818 3.54061 4.34021 3.46554 4.54151 3.46554C4.63705 3.46554 4.72804 3.4826 4.8122 3.50876C4.97825 3.5554 5.12951 3.64867 5.27168 3.79426L5.88358 4.40279C6.5819 5.0989 7.30412 5.81551 8.00358 6.53095C8.46305 7.00527 8.46305 7.4887 7.99789 7.97209C7.6112 8.37134 7.20628 8.77286 6.81619 9.15958L6.41471 9.55883C5.95523 10.0161 5.89039 10.3562 6.1554 10.951C6.48409 11.6904 6.92994 12.4104 7.52134 13.152C8.88956 14.873 10.2987 16.1833 11.8273 17.1617C12.1412 17.363 12.4654 17.529 12.777 17.6883C12.9112 17.7577 13.0454 17.8248 13.1762 17.8953C13.415 18.0238 13.887 18.1637 14.384 17.6621C14.8674 17.1787 15.3474 16.693 15.8308 16.2096L15.8717 16.1687C15.9672 16.0731 16.0582 15.9821 16.1458 15.9093C16.4279 15.6761 16.868 15.4816 17.3605 15.8888C17.5902 16.0777 17.8086 16.2995 18.0383 16.5349C18.1225 16.6191 18.2067 16.7067 18.292 16.7909C18.9266 17.4199 19.5612 18.0511 20.1902 18.687C20.5575 19.0566 20.5769 19.3331 20.5507 19.5515C20.5212 19.7664 20.4165 19.9655 20.2277 20.16L20.1549 20.2362C19.6045 20.7981 19.0403 21.3805 18.4694 21.9333C18.0156 22.3734 17.4412 22.5623 16.661 22.5327C15.6772 22.4951 14.6752 22.2529 13.6038 21.7956C10.4182 20.4352 7.64087 18.3331 5.34682 15.5465C3.72498 13.5776 2.59219 11.6006 1.8826 9.50086C1.60282 8.67395 1.47772 7.95166 1.47772 7.15999V7.13041C1.44815 6.45818 1.71883 5.85533 2.28408 5.34576L2.27137 5.35258Z" fill="#1C58A6"/>
                            <path d="M12.7774 0.00551851C12.3949 -0.0437922 12.0494 0.243098 12.0047 0.636447C11.9601 1.0298 12.2358 1.38506 12.6183 1.43099C17.5788 2.01372 21.8747 6.29694 22.6135 11.3892C22.6636 11.7445 22.9622 12 23.3022 12C23.336 12 23.3719 12 23.4057 11.991C23.7882 11.9339 24.0498 11.5663 23.992 11.1763C23.1496 5.3668 18.4342 0.667819 12.7741 0.00452863L12.7774 0.00551851Z" fill="#1C58A6"/>
                            <path d="M18.5868 11.3777C18.6379 11.7397 18.9422 12 19.2888 12C19.3232 12 19.3599 12 19.3943 11.9909C19.7841 11.9326 20.0507 11.5615 19.9919 11.1608C19.4454 7.38713 16.341 4.30887 12.7702 4.00282C12.3782 3.96743 12.0372 4.26887 12.0027 4.66963C11.9683 5.07269 12.2615 5.42322 12.6514 5.45862C15.1793 5.67442 18.0905 7.94891 18.5881 11.3743L18.5868 11.3777Z" fill="#1C58A6"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_38_3075">
                            <rect width="24" height="24" fill="white"/>
                            </clipPath>
                            </defs>
                            </svg>


                            <p class="montserrat-semiBold font-15 mb-0 title-blue">
                                {{$contact->phone_one}}
                            </p>
                        </div>
                    @endif
                    
                    @if (isset($contact) && $contact->name_one != null)                            
                        <div class="d-flex col-12 col-lg-3 gap-2 justify-content-center justify-content-lg-start align-items-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M23.7638 8.2474C23.9057 8.33606 24 8.49097 24 8.66829V20.8751C24 21.4587 23.7549 21.9907 23.3618 22.3765C22.9688 22.7613 22.4289 23 21.8344 23H2.16458C1.5701 23 1.02918 22.7613 0.637165 22.3765C0.243148 21.9916 0 21.4606 0 20.8751V8.66829C0 8.48902 0.096271 8.33215 0.240178 8.24448L10.9311 0.355621C11.2526 0.118868 11.6268 0 12 0C12.3731 0 12.7473 0.11789 13.0689 0.355621L23.7638 8.24647L23.7638 8.2474ZM22.9837 20.8762V19.5521L17.932 15.3958C17.7176 15.2195 17.6888 14.9048 17.8684 14.6943C18.0481 14.4839 18.3687 14.4556 18.583 14.632L22.9836 18.2525V9.66507L13.0689 16.98C12.7483 17.2168 12.3741 17.3356 12 17.3356C11.6268 17.3356 11.2527 17.2168 10.9311 16.98L1.01716 9.66407V18.2525L5.41771 14.632C5.63209 14.4556 5.95266 14.4839 6.13229 14.6943C6.31193 14.9048 6.28315 15.2195 6.06877 15.3958L1.01703 19.5521V20.8762C1.01703 21.1851 1.14705 21.4676 1.35447 21.6712C1.5619 21.8758 1.84872 22.0025 2.16532 22.0025H21.8352C22.1518 22.0025 22.4396 21.8748 22.648 21.6712C22.8544 21.4686 22.9844 21.186 22.9844 20.8762H22.9837ZM11.5385 1.15169L1.35063 8.66941L2.01856 9.16241L11.6863 2.02954C11.862 1.89314 12.1151 1.88437 12.3026 2.02272L21.9803 9.16332L22.6492 8.67032L12.4604 1.1526C12.3224 1.05128 12.1606 0.999638 11.9989 0.999638C11.8371 0.999638 11.6753 1.05128 11.5374 1.1526L11.5385 1.15169ZM2.86135 9.78381L11.5385 16.1869C11.6764 16.2882 11.8392 16.3398 12 16.3398C12.1617 16.3398 12.3235 16.2882 12.4615 16.1869L21.1396 9.78381L12.0008 3.04079L2.86206 9.78381H2.86135ZM12.0001 8.23762C12.5053 8.23762 12.9638 8.4393 13.2943 8.76374C13.6248 9.08819 13.8303 9.53831 13.8303 10.0342V10.7552C13.8303 10.8195 13.8521 10.877 13.8878 10.9189C13.9255 10.9627 13.9791 10.9939 14.0407 11.0046C14.1062 11.0163 14.1697 11.0036 14.2183 10.9754C14.264 10.9491 14.3017 10.9062 14.3245 10.8536L14.3295 10.839C14.3751 10.7123 14.4099 10.5798 14.4337 10.4425C14.4565 10.3109 14.4684 10.1736 14.4684 10.0333C14.4684 9.36295 14.1925 8.75597 13.7469 8.31851C13.2993 7.87911 12.682 7.60825 11.9982 7.60825C11.3163 7.60825 10.699 7.88006 10.2514 8.31851C9.8048 8.75694 9.52789 9.36295 9.52789 10.0333C9.52789 10.6022 9.72837 11.1323 10.0688 11.5502C10.4112 11.9692 10.8955 12.278 11.4583 12.4008C11.7312 12.4602 11.9039 12.7252 11.8433 12.9932C11.7828 13.2611 11.5128 13.4306 11.2399 13.3712C10.443 13.1968 9.76014 12.7632 9.27877 12.1728C8.79544 11.5814 8.51159 10.8322 8.51159 10.0323C8.51159 9.08722 8.90264 8.23082 9.53185 7.61313C10.1631 6.99348 11.0345 6.61157 11.9962 6.61157C12.9559 6.61157 13.8273 6.99448 14.4585 7.61313L14.4615 7.61606C15.0907 8.23571 15.4817 9.09114 15.4817 10.0323C15.4817 10.2252 15.4648 10.4181 15.4311 10.6081C15.3984 10.7991 15.3477 10.9871 15.2832 11.1674L15.2713 11.1966C15.1651 11.4713 14.9706 11.6896 14.7274 11.8299C14.4764 11.975 14.1756 12.0345 13.8709 11.9838C13.5633 11.9322 13.2973 11.7773 13.1107 11.56L13.0591 11.4957C12.7594 11.7052 12.3931 11.8289 11.9962 11.8289C11.492 11.8289 11.0354 11.6272 10.704 11.3028C10.3705 10.9754 10.166 10.5272 10.166 10.0323C10.166 9.53637 10.3715 9.08625 10.702 8.7618L10.7357 8.7316C11.0642 8.42372 11.5089 8.23568 11.9962 8.23568L12.0001 8.23762ZM12.5767 9.46912C12.4299 9.32493 12.2254 9.23529 12.0001 9.23529C11.7847 9.23529 11.5892 9.31713 11.4443 9.44866L11.4245 9.4701C11.2776 9.61429 11.1863 9.81499 11.1863 10.0362C11.1863 10.2573 11.2776 10.458 11.4235 10.6022C11.5704 10.7454 11.7748 10.8351 12.0001 10.8351C12.2244 10.8351 12.4289 10.7454 12.5767 10.6012C12.7236 10.458 12.8149 10.2573 12.8149 10.0352C12.8149 9.81499 12.7236 9.61428 12.5767 9.46912Z" fill="#1C58A6"/>
                            </svg>

                            <p class="montserrat-semiBold font-15 mb-0 title-blue">
                                {{$contact->name_one}}
                            </p>
                        </div>
                    @endif                    
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