<footer class="site-footer">
    <div class="footer-top">
        <div class="container">
            <div class="footer-column-wrapper">
                <div class="footer-column">
                    <div class="ft-logo">
                    @php
                    $logo = \App\Models\Settings::where(['slug' => 'website_logo'])->first();
                    @endphp
                        <a href="{{ URL('/') }}">
                            <img src="{{ URL::asset('public/uploads/frontend/logo/'.$logo->value) }}" alt="logo" />
                        </a>
                    </div>
                    <p>
                        Xtreme long shot provides editorial videos for (news, current affairs shows, document films) Broadcast TV & Internet.
                    </p>
                </div>
                <div class="footer-column mobmrgnw">
                    <h5>Company & Info</h5>
                    <div class="list-wrapper">
                        <ul>
                            <li><a href="{{ Route('about-us') }}">About Us</a></li>
                            <li><a href="{{ Route('how_it_works') }}">How It Works</a></li>
                            <li><a href="{{ Route('careers') }}">Careers</a></li>
                            <li><a href="{{ Route('blog') }}">Blog</a></li>
                        </ul>
                        <ul>
                            <li><a href="{{ Route('listing') }}">Categories</a></li>
                            <li><a href="{{ Route('privacy-policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ Route('terms-and-conditions') }}">Terms & Conditions</a></li>
                            <li><a href="{{ Route('faq') }}">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-column">
                    <h5>Follow Us</h5>
                    <ul class="social-links">
                        @php
                        $f_url = \App\Models\Settings::where(['slug'=>'facebook_url'])->first();
                        @endphp
                        <li><a href="{{ $f_url->value }}"><i class="icofont-facebook"></i></a></li>
                        @php
                        $i_url = \App\Models\Settings::where(['slug'=>'instra_url'])->first();
                        @endphp
                        <li><a href="{{ $i_url->value }}"><i class="icofont-instagram"></i></a></li>
                        @php
                        $l_url = \App\Models\Settings::where(['slug'=>'linkedin_url'])->first();
                        @endphp
                        <li><a href="{{ $l_url->value }}"><i class="icofont-linkedin"></i></a></li>
                        @php
                        $t_url = \App\Models\Settings::where(['slug'=>'twitter_url'])->first();
                        @endphp
                        <li><a href="{{ $t_url->value }}"><i class="icofont-twitter"></i></a></li>
                    </ul>
                    <h5 class="second">Contact Us</h5>
                    @php
                    $email = \App\Models\Settings::where(['slug'=>'contact_email'])->first();
                    @endphp
                    <p><a href="mailto:{{ $email->value }}"><i class="icofont-envelope"></i>{{ $email->value }}</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="copy-right-box">
        <div class="container">
            <p>
                Copyright &copy; {{ date('Y') }} {{ config('app.name')}}. All rights reserved.
            </p>
        </div>
    </div>
</footer>