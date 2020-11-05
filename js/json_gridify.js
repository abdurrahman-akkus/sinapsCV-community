raporuTablola();

var LABELS = {};

LABELS = {
  id: {
    tag: "Id",
    css: {
      display: "none",
    },
  },
  name: {
    tag: "İsim",
    class: "searchable",
  },
  lastName: {
    tag: "Soyisim",
    class: "searchable",
  },
  identity: {
    tag: "Kimlik No",
  },
  dateOfBirth: {
    tag: "D. Tarihi",
    css: {
      display: "none",
    },
  },
  nation: {
    tag: "Uyruk",
    css: {
      display: "none",
    },
  },
  gender: {
    tag: "Cinsiyet",
    modifier: {
      M: "Erkek",
      F: "Kadın",
    },
    css: {
      display: "none",
    },
  },
  phone: {
    tag: "Ev Telefonu",
  },
  gsm: {
    tag: "Gsm",
  },
  email: {
    tag: "Eposta",
  },
  address: {
    tag: "Adres",
  },
  military: {
    tag: "Askerlik",
    class: "searchable",
    status: {
      tag: "Durum",
      modifier: {
        D: "Yapıldı",
        S: "Tecilli",
        E: "Muaf",
      },
    },
    suspension: {
      tag: "Tecil",
    },
    exempt: {
      tag: "Muafiyet",
      date: {
        tag: "Tarih",
      },
      status: {
        tag: "Durum",
        modifier: {
          I: "Süresiz",
          F: "Süreli",
        },
      },
    },
  },
  driverLicences: {
    tag: "Ehliyet",
    class: "searchable",
  },
  fatherName: {
    tag: "Baba Adı",
  },
  fatherJob: {
    tag: "Baba Mesleği",
  },
  motherName: {
    tag: "Anne Adı",
  },
  motherJob: {
    tag: "Anne Mesleği",
  },
  siblingsCount: {
    tag: "Kardeş Say.",
  },
  marital: {
    tag: "Evlilik",
    class: "searchable",
    status: {
      tag: "Durum",
      modifier: {
        S: "Bekar",
        M: "Evli",
      },
    },
    partnerJob: {
      tag: "Eşin İşi",
    },
    childStates: {
      tag: "Çocuk Durumu",
      age: {
        tag: "Yaş",
      },
      custody: {
        tag: "Velayet",
        modifier: {
          M: "Anne",
          F: "Baba",
          U: "Beraber",
        },
      },
    },
    childrenCount: {
      tag: "Çocuk Say.",
    },
    partnerWorkplace: {
      tag: "Eşin İş Yeri",
    },
  },
  educationLevel: {
    tag: "Eğitim Sev.",
    class: "searchable",
    modifier: {
      0: "Yok",
      1: "İlkokul",
      2: "Ortaokul",
      3: "Lise",
      4: "Yüksekokul",
      5: "Lisans",
      6: "Lisansüstü",
    },
  },
  schools: {
    tag: "Okullar",
    class: "searchable",
    name: {
      tag: "Okul Adı",
    },
    department: {
      tag: "Bölüm",
    },
    status: {
      tag: "Durum",
      modifier: {
        0: "Devam",
        1: "Bitti",
      },
    },
  },
  courses: {
    tag: "Kurslar",
    class: "searchable",
    name: {
      tag: "Adı",
    },
    date: {
      tag: "Tarih",
    },
  },
  experiences: {
    tag: "Deneyimler",
    class: "searchable",
    job: {
      tag: "Meslek",
    },
    phone: {
      tag: "Tel",
    },
    sector: {
      tag: "Sektör",
    },
    leaving: {
      tag: "Ayrılma",
      reason: {
        tag: "Sebep",
        modifier: {
          0: "İstifa",
          1: "Sağlık",
          2: "İşten Çık.",
          3: "Diğer",
        },
      },
      explaination: {
        tag: "Açıklama",
      },
    },
    workplace: {
      tag: "İşyeri",
    },
    durationYear: {
      tag: "Yıl",
    },
    durationMonth: {
      tag: "Ay",
    },
  },
  foreignLanguages: {
    tag: "Yabancı Dil",
    class: "searchable",
    name: {
      tag: "Dil",
    },
    r: {
      tag: "O",
    },
    s: {
      tag: "K",
    },
    w: {
      tag: "Y",
    },
  },
  programs: {
    tag: "Programlar",
    class: "searchable",
    name: {
      tag: "Adı",
    },
    level: {
      tag: "Seviye",
    },
  },
  officeEquipments: {
    tag: "Ofis Araçları",
  },
  livesWith: {
    tag: "Kimle Yaşar",
    modifier: {
      P: "Ebeveynlerle",
      F: "Çekirdek Aile",
      S: "Yalnız",
      O: "Diğer",
    },
  },
  homeOwnership: {
    tag: "Ev Sahipliği",
    modifier: {
      O: "Ev Sahibi",
      R: "Kiracı",
    },
  },
  illnesses: {
    tag: "Hastalıklar",
  },
  jobs: {
    tag: "Talep Ed. İş",
    class: "searchable",
  },
  anySalary: {
    tag: "Uyg. Gör.",
    modifier: {
      true: "<input type='checkbox' checked disabled><label hidden>E</label>",
      false: "<input type='checkbox' disabled><label hidden>H</label>",
    },
  },
  salary: {
    tag: "Maaş",
  },
  asap: {
    tag: "En Yak. Tar.",
    modifier: {
      true: "<input type='checkbox' checked disabled><label hidden>E</label>",
      false: "<input type='checkbox' disabled><label hidden>H</label>",
    },
  },
  startDate: {
    tag: "Başlama Tar.",
  },
  lastStatement: {
    tag: "Son Söz",
    class: "w-25",
  },
  credentials: {
    tag: "Referans",
    tel: {
      tag: "Tel",
    },
    name: {
      tag: "Adı",
    },
    workplace: {
      tag: "İş Yeri",
    },
    relationship: {
      tag: "İlişki",
    },
  },
  requestDate: {
    tag: "Talep Tarihi",
  },
  lawConformation: {
    tag: "Onay",
    modifier: {
      true: "<input type='checkbox' checked disabled><span hidden>E</span>",
      false: "<input type='checkbox' disabled><span hidden>H</span>",
    },
  },
  isActive: {
    tag: "Aktif Mi",
    modifier: {
      1: "<input type='checkbox' checked disabled><label hidden>E</label>",
      0: "<input type='checkbox' disabled><label hidden>H</label>",
    },
  },
  isSeen: {
    tag: "İncelendi",
    modifier: {
      1: "<input type='checkbox' checked onclick='toggleIsSeen($(this))'><label hidden>E</label>",
      0: "<input type='checkbox' onclick='toggleIsSeen($(this))'><label hidden>H</label>",
    },
    class: "searchable",
  },
};

function setLabels(argument) {
  LABELS = argument;
}

setLabels(LABELS);

function raporuTablola(argument) {
  //var URL = argument.attr('baglanti');
  //loadingAc();

  $("#senkronize").removeClass("btn-danger").addClass("btn-primary");
  $("#senkronize i").removeClass().addClass("fas fa-sync-alt fa-spin");
  $("#senkronize span").text("Senkronize Ediliyor");
  $.ajax({
    url: "http://120.120.16.148:8080/sinapsIK/general",
    type: "GET",
    timeout: 5000,
  })
    .done(function (result) {
      let data;
      var htmlEtiketleri = "";
      //tabloYapici(result, htmlEtiketleri);

      data = gridify(result, htmlEtiketleri, null, "");
      data == ""
        ? $(".tablo-container").html(
            "<div class='alert alert-warning'>Gösterilecek Hiç Bir Şonuç Bulunamadı!</div>"
          )
        : $(".tablo-container").html(data);
      $(".gridify-table").each(function (i1, el1) {
        let params = [];
        $(el1)
          .find("thead th")
          .each(function (i2, el2) {
            let param;
            if ($(el1).parent("[gridify-content]").length > 0) {
              param =
                $(el1).parent("[gridify-content]").attr("gridify-content") +
                "-" +
                $(el2).text();
            } else {
              param = $(el2).text();
            }
            $(el2).attr("gridify-title", param);
            //console.log(param+"/"LABELS[param])
            //if (LABELS[param].css!==undefined) $(el2).css(LABELS[param].css);
            params.push($(el2).text());
          });

        $(el1)
          .find("tbody tr")
          .each(function (i3, el3) {
            $(el3)
              .children("td")
              .each(function (i4, el4) {
                let param;
                if ($(el1).parent("[gridify-content]").length > 0) {
                  param =
                    $(el1).parent("[gridify-content]").attr("gridify-content") +
                    "-" +
                    params[i4];
                } else {
                  param = params[i4];
                }
                $(el4).attr("gridify-content", param);
              });
          });
      });
      cssRender();

      /*$('.dataTables-example').DataTable({
                orderCellsTop: true,
                fixedHeader: true
            });*/
      var table = $(".data-table").DataTable({});
      // Setup - add a text input to each footer cell
      //$('.dataTables-example').first().find('thead tr').clone(true).appendTo('.dataTables-example thead');
      $(".data-table")
        .find("thead tr th")
        .each(function (i) {
          var title = $(this).text();
          if ($(this).hasClass("searchable"))
            $(this).html(
              '<div class="input-container" onclick="event.stopPropagation()"><input type="text" placeholder="" class="custom-input form-control form-control-lg search-input" style="width:100%;"> <span class="floating-label-lg">' +
                title +
                "</span></div>"
            );

          $("input", this).on("keyup change", function () {
            if (table.column(i).search() !== this.value) {
              table.column(i).search(this.value).draw();
              $(".paginate_button").on("click", (event) => {
                setAllGridifyColumnStatus();
              });
              setAllGridifyColumnStatus();
            }
          });
        });
      $(".paginate_button").on("click", (event) => {
        setAllGridifyColumnStatus();
      });
      setAllGridifyColumnStatus();
      setRefreshButton("done");
      checkIsSeenNotification();
    })
    .fail(() => {
      setRefreshButton("fail");
    });
}

function setRefreshButton(type) {
  $("#senkronize").removeClass();
  $("#senkronize i").removeClass();
  switch (type) {
    case "done":
      $("#senkronize").addClass("btn btn-success");
      $("#senkronize i").addClass("fas fa-check");
      $("#senkronize span").text("Tamamlandı");
      setTimeout(setOriginalRefreshButton, 2000);
      break;
    case "fail":
      $("#senkronize").addClass("btn btn-danger");
      $("#senkronize i").addClass("fas fa-exclamation-circle");
      $("#senkronize span").text("Tamamlanamadı");
      setTimeout(setOriginalRefreshButton, 5000);
      break;

    default:
      setOriginalRefreshButton();
      break;
  }
}

function setOriginalRefreshButton() {
  $("#senkronize").removeClass().addClass("btn btn-primary");
  $("#senkronize i").removeClass().addClass("fas fa-sync-alt");
  $("#senkronize span").text("Yenile");
}

function getByRealPath(data, path) {
  let pathArr = path.split("-");
  let result = data;
  for (p of pathArr) {
    result = result[p];
  }
  return result;
}
function setByRealPath(data, path) {
  let pathArr = path.split("-");
  let elm = data;
  for (p of pathArr) {
    if (data[p] === undefined) data[p] = {};
    elm = data;
  }
}

function cssRender() {
  $("[gridify-title]").each(function (index, el) {
    let result = getByRealPath(LABELS, $(el).attr("gridify-title"));
    if (result !== undefined) {
      if (result.tag !== undefined) $(el).text(result.tag);
      if (result.css !== undefined) $(el).css(result.css);
      if (result.class !== undefined) $(el).addClass(result.class);
    }
  });
  $("[gridify-content]").each(function (index, el) {
    let result = getByRealPath(LABELS, $(el).attr("gridify-content"));

    if (result !== undefined) {
      if (result.css !== undefined) $(el).css(result.css);
      if (result.modifier !== undefined)
        $(el).html(result.modifier[$(el).text()]);
      if (result.class !== undefined) $(el).addClass(result.class);
    }
  });
}

function gridify(data, htmlEtiketleri, parent) {
  let tip = typeof data;
  if (isENUZ(data)) {
    //Eğer veri yoksa, boşsa, undefined ise boş döner
    return "";
  } else if (isPrimitive(tip)) {
    //Eğer veri primitive bir değer ise tek değer döner
    return "<td>" + data + "</td>";
  } else if (Array.isArray(data)) {
    //Eğer veri bir dizi ise
    if (parent != null) {
      htmlEtiketleri += createButton();
      htmlEtiketleri +=
        "<table class='table table-striped gridify-table' style='display:none;'>";
    } else {
      htmlEtiketleri +=
        "<table class='table table-striped gridify-table data-table'>";
    }
    if (
      typeof data[0] == "object" &&
      !isENUZ(data[0]) &&
      !isPrimitive(data[0]) &&
      !Array.isArray(data[0])
    ) {
      htmlEtiketleri += "<thead><tr>";
      for (d in data[0]) {
        htmlEtiketleri += "<th>" + d + "</th>";
      }
      htmlEtiketleri += "</tr></thead>";
    }
    htmlEtiketleri += "<tbody>";
    for (d in data) {
      htmlEtiketleri += "<tr>";
      if (isPrimitive(typeof data[d]) || isENUZ(data[d])) {
        htmlEtiketleri += "<td>" + data[d] + "</td>";
      } else {
        htmlEtiketleri += gridify(data[d], "", data);
      }
      htmlEtiketleri += "</tr>";
    }
    htmlEtiketleri += "</tbody></table>";
    return htmlEtiketleri;
  } else {
    //Eğer veri kesinlikle bir object ise
    if (
      typeof parent == "object" &&
      !Array.isArray(parent) &&
      !isENUZ(parent)
    ) {
      htmlEtiketleri += createButton();
      htmlEtiketleri +=
        "<table class='table table-striped gridify-table' style='display:none;'><thead><tr>";
      for (d in data) {
        htmlEtiketleri += "<th>" + d + "</th>";
      }
      htmlEtiketleri += "</tr></thead><tbody><tr>";
      for (d in data) {
        if (isPrimitive(typeof data[d]) || isENUZ(data[d])) {
          htmlEtiketleri += "<td>" + data[d] + "</td>";
        } else {
          htmlEtiketleri += "<td>" + gridify(data[d], "", data) + "</td>";
        }
      }
      htmlEtiketleri += "</tr></tbody></table>";
    } else {
      for (d in data) {
        if (isPrimitive(typeof data[d]) || isENUZ(data[d])) {
          htmlEtiketleri += "<td>" + data[d] + "</td>";
        } else htmlEtiketleri += "<td>" + gridify(data[d], "", data) + "</td>";
      }
    }
    return htmlEtiketleri;
  }
}

function isPrimitive(tip) {
  return (
    tip == "number" ||
    tip == "string" ||
    tip == "bigint" ||
    tip == "symbol" ||
    tip == "boolean"
  );
}

function isENUZ(data) {
  return data == "" || data == null || data == undefined || data.length == 0;
}

function createButton() {
  return "<button class='btn btn-sm genislet-daralt' onclick='tabloGizleAc($(this))'>[+]</button>";
}

function tabloGizleAc(argument) {
  argument.siblings("table").toggle("fast", function () {
    argument.text() == "[-]" ? argument.text("[+]") : argument.text("[-]");
  });
}

function daralt(argument) {
  argument.siblings("table").hide("fast", function () {
    argument.text("[+]");
  });
}
function genislet(argument) {
  argument.siblings("table").show("fast", function () {
    argument.text("[-]");
  });
}

function tumunuDaralt() {
  $(".gridify-table table").hide("fast", function () {
    $(".genislet-daralt").text("[+]");
  });
}

function tumunuGenislet() {
  $(".gridify-table table").show("fast", function () {
    $(".genislet-daralt").text("[-]");
  });
}

// TODO Bu fonk. tablodan veriye geri dönmeyi sağlayacak. Geçici olarka askıya aldık.
function getDataFromGridify(param) {
  let data = {};
  $(param)
    .parent("[gridify-content]")
    .siblings("[gridify-content]")
    .each((index, el) => {
      let parent = $(el).attr("gridify-title");
      nestedTable = $(el).find(".gridify-table");
      if (nestedTable.length > 0) {
        if (nestedTable.find("thead").length == 0) {
          let arr = [];
          nestedTable.find("td").each((i1, e1) => arr.push($(el1).text));
          data[parent] = arr;
        } else {
          if (nestedTable.find("tbody").length == 1) {
            let obj = {};
            nestedTable.find("tbody td").each((i1, e1) => {
              obj[parent][$(el1).attr("gridify-title")] = $(el1).text();
            });
            data[parent] = obj;
          } else {
          }
        }
      } else data[parent] = $(el).text();
      //setByRealPath(data, $(el).attr("gridify-title"));
    });
  return data;
}
