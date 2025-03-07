var $j = jQuery;

$j(document).ready(function () {

    console.log( options.desktop_theme_version )

    if ( options.mobile_theme_version != 1 ) {

        if( options.desktop_theme_version == 1 ) {
            $j("body").append(
                '<div class="sb-button__desktop_theme_' + options.desktop_theme_version + '-wrap"><div class="sb-button__theme_' + options.mobile_theme_version + ' sb-button__desktop_theme_' + options.desktop_theme_version + '" id="sb-button"><div class="sb-buttons"><a href="' + options.richiedi_url + '"> ' + options.richiedi_label + ' </a><a href="' + options.prenota_url + '"> ' + options.prenota_label + ' </a></div><div class="sb-button-div"><span class="sb-button-span"> ' + options.availability_locale + ' </span><span class="sb-button-arrow"></span></div></div><div class="sb-body"><div id="sb-container" style="display:none;"></div></div><div class="informations"><div class="icon">' + options.icon_title_1 + '</div><div class="text"><span>' + options.icon_title_2 + '</span></div></div></div>'
            );
        } else {
            $j("body").append(
                '<div class="sb-button__theme_' + options.mobile_theme_version + '" id="sb-button"><div class="sb-buttons"><a href="' + options.richiedi_url + '"> ' + options.richiedi_label + ' </a><a href="' + options.prenota_url + '"> ' + options.prenota_label + ' </a></div><div class="sb-button-div"><span class="sb-button-span"> ' + options.availability_locale + ' </span><span class="sb-button-arrow"></span></div></div><div class="sb-body"><div id="sb-container" style="display:none;"></div></div>'
            );
        }
    
        (function (i, s, o, g, r, a, m) {
            i["SBSyncroBoxParam"] = r;
            (i[r] =
                i[r] ||
                function () {
                    (i[r].q = i[r].q || []).push(arguments);
                }),
                (i[r].l = 1 * new Date());
            (a = s.createElement(o)), (m = s.getElementsByTagName(o)[0]);
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m);
        })(
            window,
            document,
            "script",
            "https://cdn.simplebooking.it/search-box-script.axd?IDA=" + options.license_code,
            "SBSyncroBox"
        );
    
        var colorPalette = JSON.parse( options.js_bar_settings );

        SBSyncroBox({
            CodLang: options.language_code,
            Styles: colorPalette,
        });
    
        var button = document.getElementById("sb-button");
        button.style.setProperty( '--sb-primary', colorPalette.CustomButtonBGColor );
    
        button.onclick = function () {
            var class_sb = document.getElementsByClassName("sb");
            class_sb[0].classList.add("sb-screen-xs");
            var id_sb_button = document.getElementById("sb-button");
            var id_sb_container = document.getElementById("sb-container");
            if (id_sb_container.style.display == "none") {
                id_sb_button.classList.add("collapse");
                id_sb_button.style.display = "";
                id_sb_container.style.display = "block";
            } else {
                id_sb_button.classList.remove("collapse");
                id_sb_button.style.display = "";
                id_sb_container.style.display = "none";
            }
        };
    }
});
  
