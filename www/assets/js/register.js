$(document).ready(() => {
    console.log($("#json_cache").text());
  
    $.getJSON("assets/json/country.json")
      .done(function (data) {
        data.map((c) => {
          $("#country").append(
            '<option value="' + c.code + '">' + c.country + "</option>"
          );
        });
      })
      .fail(function (textStatus) {
        console.log("Impossible de charger la liste des pays");
      });
  
    $.getJSON("assets/json/lang.json")
      .done(function (data) {
        //on traite les possibles erreurs lors de la tentative de connexion et on remet si besoin les champs
        let json_retour = JSON.parse($("#json_cache").text());
        if (json_retour !== null && json_retour.length != 0) {
          let json_erreurs = json_retour.errors;
          let cpt = 1;
          json_erreurs.forEach((e) => {
            $("#ligne_erreur").append(
              '<div class="row"><p id="erreur_' +
                cpt +
                '" class="petit aide texte rouge">' +
                data.inscription[e] +
                "</p></div>"
            );
            if (e === "password_mismatching") {
              $("#pwd1").removeClass("bleu-clair").addClass("rouge-clair");
              $("#pwd2").removeClass("bleu-clair").addClass("rouge-clair");
            } else if (e === "password_does_not_fit") {
              $("#pwd1").removeClass("bleu-clair").addClass("rouge-clair");
            } else if (e === "invalid_email_pattern") {
              $("#email").removeClass("bleu-clair").addClass("rouge-clair");
            }
          });
  
          for (const key in json_retour) {
            if (key !== "errors") {
              $("#" + key).val(json_retour[key]);
            }
          }
        }
      })
      .fail(function (textStatus) {
        console.log("Impossible de charger le dico des erreurs");
      });
  
    $("#se_connecter").on("click", () => {
      window.location.href = "/se-connecter";
    });
  
    $("#bouton_inscription").on("click", () => {
      let est_rempli = true;
  
      let id_balises_inscriptions = [
        "firstname",
        "lastname",
        "email",
        "pwd1",
        "pwd2",
        "birthdate",
        "country",
      ];
  
      id_balises_inscriptions.forEach((e) => {
        if ($("#" + e).val() == "") {
          console.log(e + " vide");
          $("#" + e)
            .removeClass("bleu-clair")
            .addClass("rouge-clair");
          est_rempli = false;
        } else {
          $("#" + e)
            .removeClass("rouge-clair")
            .addClass("bleu-clair");
        }
      });
  
      if (!est_rempli) {
        console.log("des champs ne sont pas remplis");
      } else {
        console.log("on peut s'inscrire");
  
        $("#formulaire_inscription").submit();
      }
    });
  
    $(".focus_element").focusout(function () {
      if ($(this).val() == "") {
        $(this).removeClass("bleu-clair").addClass("rouge-clair");
      } else {
        $(this).removeClass("rouge-clair").addClass("bleu-clair");
      }
    });
  });