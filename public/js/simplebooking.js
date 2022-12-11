var $j = jQuery;

$j(document).ready(function () {
  $j("body").append(
    '<div id="sb-button"><div class="sb-button-div"><span class="sb-button-span"> ' +
      options.availability_locale +
      ' </span><span class="sb-button-arrow"></span></div></div><div class="sb-body"><div id="sb-container" style="display:none;"></div></div>'
  );

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
    "https://cdn.simplebooking.it/search-box-script.axd?IDA=" + options.codice,
    "SBSyncroBox"
  );

  SBSyncroBox({
    CodLang: options.language_code,
    Styles: {
      CustomColor: "#676767",
      CustomLabelColor: "#676767",
      CustomWidgetColor: "#676767",
      CustomWidgetElementHoverColor: "#676767",
      CustomWidgetElementHoverBGColor: "#676767",
      CustomBoxShadowColor: "#ffffff",
      CustomBoxShadowColorHover: "#ffffff",
      CustomIntentSelectionColor: "#9f8b3e",
      CustomIntentSelectionDaysBGColor: "#9f8b3e",
      CustomButtonHoverBGColor: "#676767",
      CustomLabelHoverColor: "#9f8b3e",
      CustomButtonBGColor: "#9f8b3e",
      CustomIconColor: "#9f8b3e",
      CustomLinkColor: "#9f8b3e",
      CustomBoxShadowColorFocus: "#9f8b3e",
      CustomAddRoomBoxShadowColor: "#9f8b3e",
      CustomAccentColor: "#9f8b3e",
      CustomBGColor: "#e0e0e0",
      CustomFieldBackgroundColor: "#ffffff",
      CustomWidgetBGColor: "#ffffff",
      CustomSelectedDaysColor: "#676767",
      CustomCalendarBackgroundColor: "#ffffff",
    },
  });

  document.getElementById("sb-button").onclick = function () {
    var class_sb = document.getElementsByClassName("sb");
    console.log(class_sb.length);
    console.log(class_sb[0]);
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
});
