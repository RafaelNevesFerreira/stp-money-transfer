                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> © {{env("APP_NAME")}} - {{env("APP_URL")}}
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-end footer-links d-none d-md-block">
                                    <a href="{{route("about")}}">About</a>
                                    <a href="{{route("help")}}">Support</a>
                                    <a href="{{route("contact")}}">Contact</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->
