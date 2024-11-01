<main role="main" id="html">
    <div class="container pt-3">
        <div class="modal-dialog modal-xl cascading-modal mx-2 my-3">
            <div class="modal-content">
                <div class="modal-header tariffuxx-blue-color white-text">
                    <h4 class="title">Über das Plugin</h4>
                </div>
                <div class="modal-body">
                    <div>Mit dem TARIFFUXX Plugin fügst du Tarifvergleiche für Handy- und Festnetz-Tarife einfach in dein Wordpress ein. Neben dem Mehrwert für deine Leser kannst du mit der Vermittlung von Tarifen Provisionen verdienen.</div>
                </div>
            </div>
        </div>
        <div class="modal-dialog modal-xl cascading-modal mx-2 my-3">
            <div class="modal-content">
                <div class="modal-header tariffuxx-blue-color white-text">
                    <h4 class="title">So legst du los</h4>
                </div>
                <div class="modal-body">
                    <div class="mb-3">Erstelle deinen ersten Vergleich mit Klick auf "Neuer Vergleich":</div>
                    <ol>
                        <li>Vergib einen Namen und entscheide dich für eine Vorauswahl.</li>
                        <li>Im 2. Schritt konfigurierst du deinen Vergleich mit zahlreichen Einstellungen (Allgemein, Filter und Farben) nach deinen Vorstellungen.</li>
                        <li>Binde deinen Tarifvergleich im 3. Schritt via Shortcode <code>[tariffuxx_configurator id="ID"]</code> ein</li>
                    </ol>
                    <div><strong>Tipp:</strong> Über den "Vorschau" Button kannst du deinen Vergleich jederzeit ansehen.</div>
                </div>
            </div>
        </div>

        <div class="modal-dialog modal-xl cascading-modal mx-2 my-3">
            <div class="modal-content">
                <div class="modal-header tariffuxx-blue-color white-text">
                    <h4 class="title">Provisionen verdienen</h4>
                </div>
                <div class="modal-body">
                    <div class="mb-3">Für die Vermittlung von Tarifen zahlen wir dir Provisionen. Dazu benötigst du einen Partner-Account und musst deine Partner-ID in den Einstellungen speichern. </div>

                    <?php if (empty(get_option('tariffuxx_partner_id'))) { ?>
                        <div class="alert alert-warning">
                            <p><i class="fa fa-exclamation-triangle pr-1"></i>Du hast noch keine Partner-ID gespeichert.</p>
                            <a href="https://www.tariffuxx.de/nutzer/partner-register?ref_partner_details_category_id=2&website=<?php echo wp_kses_post(urlencode(get_bloginfo('name'))) ?>&url=<?php echo wp_kses_post(urlencode(get_bloginfo('url'))) ?>" target="_blank" id="anmelde_link" class="btn btn-lg btn-tariffuxx-blue my-3"><i class="fas fa-user-plus pr-1"></i> zur Partner-Anmeldung</a>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-success">
                            <i class="fa fa-thumbs-up pr-1"></i>Super! Du hast eine Partner-ID hinterlegt und verdienst Provisionen.
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="modal-dialog modal-xl cascading-modal mx-2 my-3">
            <div class="modal-content">
                <div class="modal-header tariffuxx-blue-color white-text">
                    <h4 class="title">Hilfe, Verbesserungen & Fehler</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info"><i class="fa fa-info-circle pr-1"></i>Dieses Plugin steckt noch in den Kinderschuhen. Mit deinem Feedback werden wir das Plugin regelmäßig verbessern und weiterentwickeln.</div>
                    <div>Du benötigst Hilfe oder möchtest einen Fehler melden? </div>
                    <div>Bitte sende uns eine E-Mail an <a href="mailto:wordpress@tariffuxx.de">wordpress@tariffuxx.de</a></div>
                </div>
            </div>
        </div>
    </div>
</main>