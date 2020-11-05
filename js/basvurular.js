let HOST = "http://120.120.16.148:8080/sinapsIK/";
checkListDoldur();

function toggleIsSeen(param) {
  updateSeen(param);
}
function updateSeen(param) {
  let isChecked = param.prop("checked");
  let isSeen = isChecked ? 1 : 0;

  let id = param.parent("td").siblings("[gridify-content='id']").text();

  let recJSON = JSON.stringify({ isSeen: isSeen });

  //loadingAc();
  $.ajax({
    url: HOST + "general/seen/" + id,
    type: "PUT",
    data: recJSON,
    contentType: "application/json;charset=UTF-8",
    timeout: 2000,
  })
    .done((res) => {
      changeIsSeenNotification(isSeen);
    })
    .fail((err) => {
      param.prop("checked", !isChecked);
    })
    .always(
      () => {} //loadingKapat()
    );
}

function changeIsSeenNotification(isSeen) {
  let isSeenCount = parseInt($("#is_seen").text());
  if (isSeen == 0) {
    $("#is_seen").text(++isSeenCount);
  } else {
    $("#is_seen").text(--isSeenCount);
  }
  checkIsSeenNotification();
}

function checkIsSeenNotification() {
  let isSeenCount;
  let iChildren = $("#is_seen")
    .parents(".dropdown-menu")
    .siblings(".dropdown-toggle")
    .children("i");
  $.ajax({
    type: "GET",
    url: HOST + "general/isSeen/0",
  }).done((res) => {
    isSeenCount = res.length;
    $("#is_seen").text(isSeenCount);
    if (isSeenCount == 0) {
      iChildren.first().removeClass().addClass("far fa-bell fa-fw");
      iChildren.removeClass("text-danger");
    } else {
      iChildren.first().removeClass().addClass("fas fa-bell fa-fw");
      iChildren.addClass("text-danger");
    }
  });
}

function checkListDoldur() {
  $("#check_list").append("<h3>Sütunlar</h3><ul></ul>");
  let hiddenColumns = localStorage.getItem("hiddenColumns");
  hiddenColumns =
    hiddenColumns === null || hiddenColumns === undefined
      ? {}
      : JSON.parse(hiddenColumns);
  for (const l in LABELS) {
    let seen =
      hiddenColumns[l] !== undefined
        ? "none"
        : LABELS[l].css === undefined
        ? ""
        : LABELS[l].css.display === undefined
        ? ""
        : LABELS[l].css.display;
    let checked = "";
    if (seen != "none") checked = "checked";
    $("#check_list ul").append(
      `<li><input type='checkbox' ${checked} onclick='gridifyColumnToggle($(this),"${l}")' id='column_${l}'>` +
        `<label for='column_${l}'>&nbsp;${LABELS[l].tag}</label></li>`
    );
  }
}
function gridifyColumnToggle($elm, key) {
  let hiddenColumns = localStorage.getItem("hiddenColumns");
  hiddenColumns = hiddenColumns ? JSON.parse(hiddenColumns) : {};
  if ($elm.attr("checked")) {
    $elm.attr("checked", false);
    gridifyColumnHide(key);
    hiddenColumns[key] = "";
  } else {
    $elm.attr("checked", true);
    gridifyColumnShow(key);
    delete hiddenColumns[key];
  }
  localStorage.setItem("hiddenColumns", JSON.stringify(hiddenColumns));
}

function gridifyColumnShow(key) {
  $("[gridify-content='" + key + "']").show();
  $("[gridify-title='" + key + "']").show();
}
function gridifyColumnHide(key) {
  $("[gridify-content='" + key + "']").hide();
  $("[gridify-title='" + key + "']").hide();
}

function setAllGridifyColumnStatus() {
  $("#check_list [type=checkbox]").each((index, $elm) => {
    let key = $($elm).attr("id").replace("column_", "");
    if ($($elm).attr("checked")) {
      gridifyColumnShow(key);
    } else {
      gridifyColumnHide(key);
    }
  });
}
