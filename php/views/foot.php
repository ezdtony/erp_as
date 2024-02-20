<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>


<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script src="/erp_as/js/form.js"></script>
<section id="contact">
    <div class="container-fluid bg-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Nuestras oficinas</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Av Parque de Chapultepec 1, Campo Militar 1 A, 53538 Naucalpan de Juárez, Méx.</p>
                    <p class="mb-2"><i class="faf fa-phone-alt me-3"></i>+52 1 55 5357 4888</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>contacto@astelecom.com.mx</p>
                    <div class="d-flex pt-3">
                        <!-- <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a> -->
                        <a class="btn btn-square btn-primary rounded-circle me-2" href="https://www.facebook.com/ASTELECOM?mibextid=ZbWKwL"><i class="fab fa-facebook-f"></i></a>
                        <!-- <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i class="fab fa-youtube"></i></a> -->
                        <a class="btn btn-square btn-primary rounded-circle me-2" href="https://www.linkedin.com/company/astelecomsadecv/"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <!--  <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-4">Quick Links</h5>
                <a class="btn btn-link" href="">About Us</a>
                <a class="btn btn-link" href="">Contact Us</a>
                <a class="btn btn-link" href="">Our Services</a>
                <a class="btn btn-link" href="">Terms & Condition</a>
                <a class="btn btn-link" href="">Support</a>
            </div> -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Horarios de atención</h5>
                    <p class="mb-1">Lunes - Viernes</p>
                    <h6 class="text-light">09:00 am - 07:00 pm</h6>
                </div>
                <!-- <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-4">Newsletter</h5>
                <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                <div class="position-relative w-100">
                    <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                    <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                </div>
            </div> -->

                <!-- form contac -->
                <div class="col-lg-6 col-md-12">
                    <form method="POST" id="formcontac" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                            <h5 class="text-white mb-4">Contáctanos:</h5>
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control rounded-pill" id="name" name="name" placeholder="Ingrese su nombre">

                            <label for="email">Correo electrónico:</label>
                            <input type="email" class="form-control rounded-pill" id="email" name="email" placeholder="Ingrese su correo electrónico">

                            <label for="mensaje">Mensaje:</label>
                            <textarea class="form-control rounded" id="mensaje" rows="4" name="mensaje" placeholder="Ingrese su mensaje"></textarea>

                            <br><button type="submit" class="btn btn-primary" id="btnenviar">Enviar</button>

                            <br><br><div id="mensajeExito"></div>
                             <div id="mensajeError"></div>
                        </div>
                    </form>
                </div>
                <!-- end form contac -->

            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container text-center">
            <p class="mb-2">Copyright &copy; <a class="fw-semi-bold" href="#">ASTELECOM</a>, Todos los derechos reservados.
            </p>
            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
            <!-- <p class="mb-0">Designed By <a class="fw-semi-bold" href="https://htmlcodex.com">HTML Codex</a> Distributed
            By: <a href="https://themewagon.com">ThemeWagon</a> </p> -->
        </div>
    </div>
    <!-- Copyright End -->


</section>

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>
<script>
    /* evita el renvio del formulario */
    if (window.history.replaceState) {
			window.history.replaceState(null,null, window.location.href)
		}
</script>