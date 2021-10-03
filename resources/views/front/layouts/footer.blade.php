<div class="footer">
    <div class="inside-footer">
        <div class="container">
            <div class="row">
                <div class="details col-md-4">
                    <img src={{ asset("front/imgs/logo.png") }}>
                    <h4>بنك الدم</h4>
                    <p>
                        {{ $settings->intro }}
                    </p>
                </div>
                <div class="pages col-md-4">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action @if(Route::current()->getName() == 'front.index') active @endif " id=" list-home-list" href="{{ route("front.index") }}" role="tab" aria-controls="home">الرئيسية</a>
                        <a class="list-group-item list-group-item-action @if(Route::current()->getName() == 'about-blood-bank') active @endif " id=" list-profile-list" href="{{ route("about-blood-bank") }}" role="tab" aria-controls="profile">عن بنك الدم</a>
                        <a class="list-group-item list-group-item-action @if(Route::current()->getName() == 'article-details') active @endif " id=" list-messages-list" href="{{ route("article-details") }}" role="tab" aria-controls="messages">المقالات</a>
                        <a class="list-group-item list-group-item-action @if(Route::current()->getName() == 'client-donation-request.index') active @endif " id=" list-settings-list" href="{{ route("client-donation-request.index") }}" role="tab" aria-controls="settings">طلبات التبرع</a>

                        <a class="list-group-item list-group-item-action @if(Route::current()->getName() == 'who-are-us' ) active @endif " id=" list-settings-list" href="{{ route("who-are-us") }}" role="tab" aria-controls="settings">من نحن</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" href="{{ route('contact-us') }}" role="tab" aria-controls="settings">اتصل بنا</a>
                    </div>
                </div>
                <div class="stores col-md-4">
                    <div class="availabe">
                        <p>متوفر على</p>
                        <a href="{{ $settings->app_store_link }}">
                            <img src={{ asset("front/imgs/google1.png") }}>
                        </a>
                        <a href="{{ $settings->google_play_link }}">
                            <img src={{ asset("front/imgs/ios1.png") }}>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="other">
        <div class="container">
            <div class="row">
                <div class="social col-md-4">
                    <div class="icons">
                        <a href="{{ $settings->fb_link }}" class="facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{ $settings->insta_link }}" class="instagram"><i class="fab fa-instagram"></i></a>
                        <a href="{{ $settings->tw_link }}" class="twitter"><i class="fab fa-twitter"></i></a>
                        <a href="{{ $settings->whats_app }}" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="rights col-md-8">
                    <p>جميع الحقوق محفوظة لـ <span>بنك الدم</span> &copy; {{ date("Y") }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

<script src={{ asset("front/assets/js/main.js") }}></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js" integrity="sha384-a9xOd0rz8w0J8zqj1qJic7GPFfyMfoiuDjC9rqXlVOcGO/dmRqzMn34gZYDTel8k" crossorigin="anonymous"></script>
<script src={{ asset("front/assets/js/owl.carousel.min.js") }}></script>
<script src={{ asset("front/assets/js/main.js") }}></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
{{-- // For toggle class favourite in the heart --}}
<script>
    $(function() {


        $(".favourite").click(function() {
            var post_id = $(this).data("post-id");
            var $class = $(this).children().attr("class")
            var element = $(this).children()
            $.ajax({
                type: "post"
                , url: '{{ url(route("client-toggle-favorite")) }}'
                , data: {
                    _token: "{{ csrf_token() }}"
                    , post_id: post_id
                }
                , success: function(data) {

                    $(this).each(function() {
                        if (data.status == 1) {
                            if ($class.includes("with-heart")) {
                                element.removeClass("with-heart").addClass("without-heart");

                            } else {

                                element.addClass("with-heart").removeClass("without-heart");

                            }
                        }
                    });
                }
            });

        })
    })

</script>

@stack('front-js')
</body>
</html>
