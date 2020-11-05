let SELECTED_INDEX = 0;
let LAST_DATA;

let pages = [
  { name: "personalInfo", link: "#personal_info_link" },
  { name: "familyInfo", link: "#family_info_link" },
  { name: "education", link: "#education_info_link" },
  { name: "skills", link: "#skills_link" },
  { name: "expInfo", link: "#experiences_link" },
  { name: "others", link: "#others_link" },
  { name: "request", link: "#request_link" },
  { name: "personalDataLaw", link: "#personal_data_law_link" },
];
var app = new Vue({
  el: "#app",
  data: initialState(),
  methods: {
    triggerChild(elem) {
      document.querySelector(elem).dispatchEvent(new Event("change"));
      /*$(elem).prop("checked")
        ? $(elem).prop("checked", false)
        : $(elem).prop("checked", true);*/
      /*$(elem).trigger("change");*/
    },
    resetChildStates() {
      let states = this.rec.marital.childStates;
      let childrenCount = this.rec.marital.childrenCount;
      let diff = childrenCount - states.length;
      if (0 < diff) {
        for (let i = 0; i < diff; i++) {
          states.push({
            age: "",
            custody: "", // M-mother, F-father, U-mutual
          });
        }
      } else if (0 > diff) {
        if (
          !confirm(
            "Çocuk Sayısını Azalttığınız İçin Sondan " +
              -1 * diff +
              " Çocuk Silinecek\n" +
              "Devam Etmek İstiyor Musunuz?"
          )
        )
          return;
        for (let i = 0; i < Math.abs(diff); i++) {
          states.pop();
        }
      }
    },
    addSchool() {
      this.rec.schools.push({
        name: "",
        department: "",
        status: "", // completed, continiue
      });
    },
    addCourse() {
      this.rec.courses.push({
        name: "",
        date: "",
      });
    },
    addForeignLanguage() {
      this.rec.foreignLanguages.push({
        name: "",
        r: "",
        w: "",
        s: "",
      });
    },
    addProgram() {
      this.rec.programs.push({
        name: "",
        level: "", // over 5
      });
    },
    addExperience() {
      this.rec.experiences.push({
        job: "",
        sector: "",
        workplace: "",
        durationYear: "", //in year&month
        durationMonth: "",
        phone: "",
        leaving: {
          reason: "", // quit, fire, health, other
          explaination: "",
        },
      });
    },
    addCredentials() {
      this.rec.credentials.push({
        name: "",
        workplace: "",
        relationship: "",
        tel: "",
      });
    },
    toArray(arr, str) {
      this.driverLicenceString = this.driverLicenceString.toLocaleUpperCase(
        "TR"
      );
      arr.push(app[str]);
      app[str] = "";
    },
    deleteEquipmentTag(data, index) {
      this.officeEquipmentsString = this.officeEquipmentsString.replace(
        data[index] + ", ",
        ""
      );
      this.deleteTag(data, index);
    },
    deleteTag(data, index) {
      data.splice(index, 1);
    },
    selectPage(selector) {
      let $item = $(selector);
      $("#list-tab .list-group-item").removeClass("active");
      $item.addClass("active");
      $("#tabs .tab-pane").removeClass("show").removeClass("active");
      $($item.attr("href")).addClass("show").addClass("active");

      this.selected = $item.attr("page");
    },
    checkAndChange(target, isForward) {
      let data = this._data;
      let selected = this.selected;
      if (!checkAllValidity(selected)) {
        //alert("Gerekli Alanları Yeniden Düzenleyiniz!");
        let durdur = false;
        if (
          confirm(
            "Gerekli Alanları Eksik Bıraktınız!\nDevam Etmek İstiyor Musunuz?"
          )
        ) {
          data[selected].status = "partial-done";
        } else {
          return;
        }
      } else {
        data[selected].status = "done";
      }
      this.saveLocal();
      this.changePage(target, isForward);
    },
    changePage(target, isForward) {
      if (target !== null) {
        this.selectPage(target);
      } else {
        for (key in pages) {
          if (pages[key].name == this.selected) {
            SELECTED_INDEX = key;
            break;
          }
        }
        if (isForward) {
          this.selectPage(pages[++SELECTED_INDEX].link);
        } else if (isForward == false) {
          this.selectPage(pages[--SELECTED_INDEX].link);
        }
      }
    },
    saveLocal() {
      localStorage.setItem("isTalep", JSON.stringify(this.rec));
    },
    getFromLocal() {
      this.rec = Object.assign({}, JSON.parse(localStorage.getItem("isTalep")));
      this.rec.lawConformation = false;
    },
    saveAndReset() {
      let rec = this.rec;
      let data = this._data;
      let type = "POST";
      let id = "";
      for (k of pages) {
        let page = k.name;
        if (typeof data[page] == "object" && data[page] != null) {
          const elm = data[page];

          if (elm.status != "done" && elm.status != undefined) {
            alert(
              "Formu Tamamlamadan Önce Tüm Bölümlerin Doldurulduğundan Emin Olun!"
            );
            return;
          }
        }
      }

      if (rec.id != null && rec.id != undefined) {
        rec["id"] = rec.id;
      }

      if (rec.id != undefined && rec.id != null && rec.id != "") {
        id = rec.id;
        type = "PUT";
      }
      let recJSON = JSON.stringify(rec);

      loadingAc();
      $.ajax({
        url: HOST + /*data.link*/ "general/" + id,
        type: type,
        data: recJSON,
        contentType: "application/json;charset=UTF-8",
        timeout: 2000,
      })
        .done((res) => {
          // Tüm bölümler tamam demektir
          localStorage.removeItem("isTalep");
          if (
            confirm(
              "Başvurunuz Alınmıştır. Uygun Görülmeniz Halinde Geri Dönüş Yapılacaktır."
            )
          )
            location.reload();
        })
        .always(() => loadingKapat());
    },
    changeInputType(selector, target) {
      let item = document.querySelector(selector);
      if (item.value == "") return;
      if (isNaN(item.value)) item.setAttribute("type", "text");
      else item.setAttribute("type", target);
    },
    getOldForm() {
      let rec = this.rec;
      let data = this._data;
      loadingAc();
      $.ajax({
        url: HOST + "general/identity/" + rec.identity,
        timeout: 5000,
      })
        .done((response) => {
          // let localData = JSON.parse(localStorage.getItem("isTalep"));

          if (response.length != 0) {
            new Promise((resolve, reject) => {
              this.rec = response[0];
              resolve();
            }).then(() => {
              for (page of pages) {
                let selectedPage = page.name;
                if (!checkAllValidity(selectedPage)) {
                  data[selectedPage].status = "partial-done";
                } else {
                  data[selectedPage].status = "done";
                }
              }
            });
          }
          this.selected = "personalInfo";
          this.selectPage("#personal_info_link");
        })
        .fail((err) => {})
        .always(() => {
          loadingKapat();
        });
    },
    initilazeState() {
      let a = this._data;
      let data = initialState();
      for (i in a) {
        if (Array.isArray(data[i])) {
          a[i] = data[i];
        } else if (typeof data[i] == "object") {
          data[i].status = "";
          a[i] = Object.assign({}, a[i], data[i]);
        } else a[i] = data[i];
      }
      LAST_DATA = Object.assign({}, a);
    },
    militaryStatusChange() {
      let status = this.rec.military.status;
      if (status == "D") {
        this.rec.military.suspension = "";
        this.rec.military.exempt.status = "";
        this.rec.military.exempt.date = "";
      }
      if (status == "S") {
        this.rec.military.exempt.status = "";
        this.rec.military.exempt.date = "";
      }
      if (status == "E") {
        this.rec.military.suspension = "";
        if (this.rec.military.exempt.status == "I") {
          // bu military status change olunca değil exempt change olunca
          this.rec.military.exempt.date = "";
        }
      }
    },
  },
  computed: {},
  created() {
    if (localStorage.getItem("isTalep") != null) {
      let identity = prompt(
        "Eski Bilgiler Mevcut. Geri Getirmek İçin TC Kimlik Numarası Giriniz:"
      );
      if (identity == null) {
        localStorage.removeItem("isTalep");
      } else if (
        JSON.parse(localStorage.getItem("isTalep")).identity == identity
      )
        this.getFromLocal();
      else localStorage.removeItem("isTalep");
    }
  },
  mounted() {
    LAST_DATA = Object.assign({}, this._data);
    (() => {
      $.ajax({
        type: "GET",
        url: HOST + "languages",
      }).done((response) => {
        this.languages = response;
      });
    })();
    this.selectPage("#personal_info_link");
  },
});

function initialState() {
  return {
    rec: {
      id: null,
      //personalInfo
      name: "",
      lastName: "",
      nation: "TC",
      gender: "",
      identity: null,
      dateOfBirth: "",
      driverLicences: [],
      phone: "",
      gsm: "",
      email: "",
      address: "",
      military: {
        status: "",
        suspension: "",
        exempt: {
          status: "",
          date: "",
        },
      },
      lawConformation: false,
      //familyInfo
      fatherName: "",
      fatherJob: "",
      motherName: "",
      motherJob: "",
      siblingsCount: "",
      marital: {
        status: "", // S-single, M-married, D-divorced, P-seperated
        partnerJob: "",
        partnerWorkplace: "",
        childrenCount: 0,
        childStates: [],
      },
      // education
      educationLevel: "", // N-no, P-primary*, H-high school*, C-collage*, G-graduate*, PG-postgraduate ,MsC-master of science*, PhD-philosophiae doctor*  *->and same level
      schools: [],
      courses: [],
      // skills
      programs: [],
      foreignLanguages: [],
      officeEquipments: [],
      // expInfo
      experiences: [
        {
          job: "",
          sector: "",
          workplace: "",
          durationYear: "", //in year&month
          durationMonth: "",
          phone: "",
          leaving: {
            reason: "", // quit, fire, health, other
            explaination: "",
          },
        },
      ],
      // request
      jobs: [], // any
      salary: "", // any
      anySalary: "",
      startDate: "",
      asap: "",
      // other
      credentials: [
        {
          name: "",
          relationship: "",
          workplace: "",
          tel: "",
        },
      ],

      livesWith: "", // P-parents, F-family, S-single, O-other
      homeOwnership: "", // renter, owner
      illnesses: [],
      lastStatement: "",
      isSeen: 0,
      isActive: 1,
    },
    personalInfo: {
      status: "",
      link: "personal_info/",
    },
    familyInfo: {
      status: "",
      link: "family_info/",
      id: "",
    },
    education: {
      status: "",
      link: "education/",
      id: "",
    },
    skills: {
      status: "",
      link: "skills/",
      id: "",
    },
    expInfo: {
      status: "",
      link: "experiences/",
      id: "",
    },
    request: {
      status: "",
      link: "request/",
      id: "",
    },
    others: {
      status: "",
      link: "others/",
      id: "",
    },
    personalDataLaw: {
      status: "",
    },
    languages: [],
    officeEquipmentsString: "",
    driverLicenceString: "",
    illnessesString: "",
    requestedJobString: "",
    selected: "personalInfo",
  };
}

function isEquivalent(a, b) {
  // Create arrays of property names
  var aProps = Object.getOwnPropertyNames(a);
  var bProps = Object.getOwnPropertyNames(b);

  // If number of properties is different,
  // objects are not equivalent
  if (aProps.length != bProps.length) {
    return false;
  }

  for (var i = 0; i < aProps.length; i++) {
    var propName = aProps[i];

    // If values of same property are not equal,
    // objects are not equivalent
    if (a[propName] !== b[propName]) {
      return false;
    }
  }

  // If we made it this far, objects
  // are considered equivalent
  return true;
}

function checkAllValidity(page) {
  let valid = true;
  let tab = $("[page=" + page + "]").attr("href");
  $($(tab + " input," + tab + " textarea," + tab + " select")).each(
    (index, elm) => {
      if (!checkSingleValidity(elm)) valid = false;
    }
  );
  return valid;
}

function checkSingleValidity(elm) {
  let singleValidity = elm.checkValidity();
  if (!singleValidity) {
    elm.reportValidity();
    return false;
  }
  return true;
}
