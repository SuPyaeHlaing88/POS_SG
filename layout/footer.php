
</div>
<script>
    let toggle = $("#sidebar-toggle");
    let sidebar = $("#sidebar");
    let collapse =localStorage.getItem("collapse");
    if(collapse){
        sidebar.removeClass("extend");
        toggle.addClass("fa-angle-right")
    }else{
        sidebar.addClass("extend");
        toggle.addClass("fa-angle-left")
    }
    toggle.on("click",()=>{
        toggle.toggleClass("fa-angle-right");
        sidebar.toggleClass("extend");
        toggleCollapse();
    })
    $(".sidebar-menu").on("click",function(){
       $(this).find("i.fa-angle-down").toggleClass("fa-angle-up");
    })
    const toggleCollapse=()=>{
        let collapse =localStorage.getItem("collapse");
        if(collapse){
            localStorage.removeItem("collapse");
        }else{
            localStorage.setItem("collapse","collapse");
        }
    }
    let url =location.href.split("/")
    console.log(url[url.length-1].includes("list"));
    let fileName = url[url.length-1];
    if(!fileName.includes("list")) $("#search-wapper").html("")
</script>
</body>
</html>