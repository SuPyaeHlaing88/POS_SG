<script>
    let toggle = $("#sidebar-toggle");
    let sidebar = $("#sidebar");
    toggle.on("click",()=>{
        toggle.toggleClass("fa-angle-right");
        sidebar.toggleClass("extend");
    })
</script>
</body>
</html>