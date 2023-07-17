$(function(){
  $(document).on("click", ".tab-item", function(){
    $(".tab-item").removeClass("active");
    $(this).addClass("active");
    let panelType = $(this).data("panel-type");
    $(".tab-content").hide();
    document.getElementById(panelType).style.display = "block";
  });

  window.openPanel = function(panelType){
    $(".tab-item").removeClass("active");
    $(`.tab-item[data-panel-type='${panelType}']`).addClass("active");
    $(".tab-content").hide();
    document.getElementById(panelType).style.display = "block";
  }
});