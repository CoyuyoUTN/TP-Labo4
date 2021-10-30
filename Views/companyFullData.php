<?php
include("nav.php");
require_once("validate-session.php");
?>

<main class="py-5">
    <section id="fulldata" class="mb-5">
        <div class="container">
            <div class="business-data">
                <div class="row header">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="<?php echo $company->getImg()?>" alt="" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                            <h5>
                                <?php echo $company->getName()?>
                            </h5>
                            <h6>
                                <?php echo $company->getShortDesc()?>
                            </h6>
                            <p class="proile-rating">RANKINGS : <span><?php echo $company->getRanking()?>/10</span></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p>PAGINAS WEB</p>
                            <a href="<?php echo $company->getWebpage()?>">Pagina Web</a><br />
                            <a href="<?php echo $company->getLinkedin()?>">Linkedin</a><br />
                            <a href="<?php echo $company->getFacebook()?>">Facebook</a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Id</label>
                                </div>
                                <div class="col-md-6">
                                    <p><?php echo $company->getId()?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-6">
                                    <p><?php echo $company->getName()?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <p><?php echo $company->getEmail()?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Phone</label>
                                </div>
                                <div class="col-md-6">
                                    <p><?php echo $company->getPhone() ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Descripcion Corta</label>
                                </div>
                                <div class="col-md-6">
                                    <p><?php echo $company->getShortDesc()?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Ciudad</label>
                                </div>
                                <div class="col-md-6">
                                    <p><?php echo $company->getCity()?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Direccion</label>
                                </div>
                                <div class="col-md-6">
                                    <p><?php echo $company->getAddress()?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Numero de Ofertas Laborales</label>
                                </div>
                                <div class="col-md-6">
                                    <p><?php echo $company->getJobOffers()?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Bio</label><br />
                                    <p><?php echo $company->getBio()?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>