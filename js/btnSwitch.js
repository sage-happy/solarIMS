const btn = document.getElementById("toggleSectionBtn");
const tablebtn = document.getElementById("tableBtn");
const chart_cont=document.getElementById("chart-section");
const table_cont=document.getElementById("table-section");

    btn.addEventListener("click", () => {  
        if(btn.textContent==='Chart'){
            chart_cont.style.display='block';
            table_cont.style.display='none';
        }
    }); 
    tablebtn.addEventListener("click", () => {  
        if(tablebtn.textContent==='Table'){
            chart_cont.style.display='none';
            table_cont.style.display='block';
        }
    });
    


