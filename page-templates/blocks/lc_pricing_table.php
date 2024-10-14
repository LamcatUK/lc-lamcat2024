<section class="pricing pb-5">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="pricing__card pricing--essential">
                    <div class="pricing__header">
                        Essential Care
                    </div>
                    <div class="pricing__intro">
                        Ideal if you just want basic maintenance and security for your site.
                    </div>
                    <div class="pricing__price">
                        <span>£</span><?= get_field('essential', 'option') ?> <span>/mo</span>
                    </div>
                    <div class="pricing__items">
                        <p>&nbsp;</p>
                        <ul>
                            <li>WP Core/Plugin/Theme Updates</li>
                            <li>Weekly Backups</li>
                            <li>Security Scans</li>
                            <li>Free hosting & SSL</li>
                            <li>Email Support</li>
                        </ul>
                    </div>
                    <div class="button mx-auto mb-4">
                        <a href="/contact-us/">Get Started</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="pricing__card pricing--growth">
                    <div class="pricing__header">
                        Growth Care
                    </div>
                    <div class="pricing__intro">
                        Suited for businesses seeking performance insights and moderate design support.
                    </div>
                    <div class="pricing__price">
                        <span>£</span><?= get_field('growth', 'option') ?> <span>/mo</span>
                    </div>
                    <div class="pricing__items">
                        <p>Everything in Essential Care plus</p>
                        <ul>
                            <li>Monthly site traffic report</li>
                            <li>24/7 Uptime monitoring</li>
                            <li>WP Core/Plugin/Theme Updates</li>
                            <li>1 hour/mo design/content services</li>
                        </ul>
                    </div>
                    <div class="button mx-auto mb-4">
                        <a href="/contact-us/">Get Started</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="pricing__card pricing--pro">
                    <div class="pricing__header">
                        Pro Care
                    </div>
                    <div class="pricing__intro">
                        For businesses that require priority support and strategic input with more hands-on management.
                    </div>
                    <div class="pricing__price">
                        <span>£</span><?= get_field('pro', 'option') ?> <span>/mo</span>
                    </div>
                    <div class="pricing__items">
                        <p>Everything in Growth Care plus</p>
                        <ul>
                            <li>2 hours/mo design/content Services</li>
                            <li>Quarterly strategy consultation</li>
                            <li>Emergency fixes and priority support</li>
                        </ul>
                    </div>
                    <div class="button mx-auto mb-4">
                        <a href="/contact-us/">Get Started</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="pricing__card pricing--elite">
                    <div class="pricing__header">
                        Elite Care
                    </div>
                    <div class="pricing__intro">
                        A premium package for businesses that need extensive design work and comprehensive care.
                    </div>
                    <div class="pricing__price">
                        <span>£</span><?= get_field('elite', 'option') ?> <span>/mo</span>
                    </div>
                    <div class="pricing__items">
                        <p>Everything in Pro Care plus</p>
                        <ul>
                            <li>4 hours/mo design/content Services</li>
                            <li>10% discount on large projects</li>
                            <li>Early access to new features</li>
                        </ul>
                    </div>
                    <div class="button mx-auto mb-4">
                        <a href="/contact-us/">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>