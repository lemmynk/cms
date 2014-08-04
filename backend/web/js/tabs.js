/**
 * Created by miller on 7/10/14.
 */
var links = $(".container-fluid").find("a");
console.log($(links));
$.each(links, function(i, v){
    var link = $(v);
    link.on("click", function(e){
        var tabLis = $("ul.nav-tabs").find("li"),
            tabDivs = $(".tab-content").find("div.tab-pane");
        e.preventDefault();
        $.each(tabLis, function(j,w){
            if($(w).hasClass("active")) $(w).removeClass("active");
        });
        $.each(tabDivs, function(k,u){
            if($(u).hasClass("active")) $(u).removeClass("active");
        });
        $.ajax({
            url: link.attr("href"),
            type: "POST",
            success: function(data){
                var list = $("<li>",{"class":"active"}).appendTo("ul.nav-tabs");
                $("<a>",{href:"#"+i, role: "tab", "data-toggle": "tab", html: link.attr("data-tabname")}).appendTo(list);
                $("<div>", {"class":"tab-pane active", id:i, html: data}).appendTo("div.tab-content");
            }
        });
    });
});

var tabLinks = $("ul.nav-tabs").find("a");
$.each(tabLinks, function(m,z){
    var tabLink = $(z);
    tabLink.on("click", function(e){
        e.preventDefault();
        this.tab('show');
    });
});
