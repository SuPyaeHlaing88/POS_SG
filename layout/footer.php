
</div>
<div id="deleteModal" class="modal fade modal-sm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title"><h5>Are you Sure?</h5></div>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Do you wanna delete?
            </div>
            <div class="modal-footer">
                <button id="confirmDelete" class="btn btn-danger">Delete</button>
                <button  class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<script>
    let toggle = $("#sidebar-toggle");
    let sidebar = $("#sidebar");
    let deleteSelect = $(".deleteSelect");
    let collapse =localStorage.getItem("collapse");
    let deleteKey = undefined;
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

    deleteSelect.on("click",function(e){
        deleteKey = e.currentTarget.getAttribute("data-value");
    })

    $("#confirmDelete").on("click",()=>location.replace("?deleteId="+deleteKey));

    let url =location.href.split("/")
    console.log(url[url.length-1].includes("list"));
    let fileName = url[url.length-1];
    if(!fileName.includes("list")) $("#search-wapper").html("")
</script>
</body>
</html>