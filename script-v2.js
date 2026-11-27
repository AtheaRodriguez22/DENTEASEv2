$(document).ready(function(){

  const currentPage = window.location.pathname.split("/").pop() || "index.php";
  $(".de-navbar .nav-link").each(function(){
    const href = $(this).attr("href");
    if(href === currentPage){ $(this).addClass("active"); }
  });

  $("#searchBtn").on("click", function(){
    const name = $("#docName").val().trim();
    const spec = $("#docSpec").val();
    const area = $("#docArea").val();

    if(!spec || !area){
      alert("Please select a specialization and an area to search.");
      return;
    }
    alert(`Searching for ${name ? name : "any dentist"} — ${spec} in ${area}...`);
  });

  const $patientForm = $("#patientForm");
  if($patientForm.length){
    $patientForm.on("submit", function(){
      $(this).find(".required").each(function(){
        if($(this).val().trim() === ""){
          $(this).addClass("error");
        } else {
          $(this).removeClass("error");
        }
      });
      // no e.preventDefault() — let the browser submit normally to process-v2.php
    });
  }

  const $authTabs = $(".auth-tabs button");
  if($authTabs.length){

    function showTab(tab){
      $(".auth-tabs button").removeClass("active");
      $(`.auth-tabs button[data-tab="${tab}"]`).addClass("active");
      $(".auth-pane").removeClass("active");
      $(`#pane-${tab}`).addClass("active");
    }

    $authTabs.on("click", function(){
      showTab($(this).data("tab"));
    });
  }

});
