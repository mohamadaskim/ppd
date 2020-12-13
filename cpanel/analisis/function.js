//GEN CARTA MAKLUM BALAS
function genMb(update,sek,tahun,bulan,bar){
    $.post('cpanel/analisis/proc/datachart.php',{cartamb:sek,tahun:tahun,bulan:bulan},function(dat){
        let len = Object.keys(dat);
        let dataset = [];
        for(let x=0;x<len.length;x++){
            dataset.push({
                label: len[x],
                backgroundColor: kaler[x],
                data: dat[len[x]]
            })
        }
        if(bulan=='all'){
            var lala = ['Jan','Feb','Mac','Apr','Mei','Jun','Jul','Ogos','Sept','Okt','Nov','Dis'];
        } else {
            var lala = ['Jan-Mac','Apr-Jun','Jul-Sept','Okt-Dis'];
        }
        if(update){
            addData(chartmb, lala, dataset);
        } else {
            chartmb = new Chart(document.getElementById('carta-mb'),genCarta(lala,dataset,true,bar));
        }
    },'json');
}

//GEN MAKLUM BALAS PIE
function genMbPie(update,sek,tahun,bulanpie){
    $.post('cpanel/analisis/proc/datapie.php',{cartamb:sek,tahun:tahun,bulanpie:bulanpie},function(dat){
        let label = Object.keys(dat);
        let dataset = Object.values(dat);
        if(update){
            updatePie(piemb, label, dataset);
        } else {
            piemb = new Chart(document.getElementById('pie-mb'),genPie(label,dataset));
        }
        
    },'json');
}

//GEN CARTA MINIT
function genMinit(update,tahun,tapis,bar){
    $.post('cpanel/analisis/proc/datachart.php',{cartaminit:tapis,tahun:tahun},function(dat){
        let labels = dat[dat.length-1];
        dat.pop();
        if(update){
            addData(chartminit, labels, dat);
        } else {
            chartminit = new Chart(document.getElementById('carta-minit'),genCarta(labels,dat,true,bar));
        }
    },'json');
}

//GEN CARTA GLOBAL
function genCarta(labels,datasets,stack,bar){
    if(bar=='bar'){
        var ratio = 2;
    } else {
        var ratio = 1;
    }

    var obj = 
    {
        type: bar,
        data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                legend: {
                    display: true,
                    labels:{
                        fontSize:10
                    }
                },
                title: {
                    display: false,
                    text: ''
                },
                scales: {
                    yAxes:[{
                        ticks:{
                            beginAtZero: true,
                        },
                        stacked: stack,
                        scaleLabel:{
                            display:false,
                            labelString:'Peratus skor maklum balas'
                        }
                    }],
                    xAxes:[{
                        stacked: stack
                    }]
                },
                aspectRatio: ratio
        }
    };
    return obj;
}

//GEN PIE GLOBAL
function genPie(labels,datasets){
    var objpie = {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                backgroundColor: kaler2,
                data: datasets
            }]
        },
        options: {
            title: {
                display: false,
            },
            legend: {
                display: false,
            },
            aspectRatio:1,
            plugins: {
                datalabels: {
                    font : {
                        size : '15'
                    }
                }
            }
        }
    };
    return objpie;
}

function addData(chart, label, data) {
    chart.data.labels = label;
    chart.data.datasets = data;
    chart.update();
}

function updatePie(chart, label, data) {
    chart.data.labels = label;
    chart.data.datasets[0].data = data;
    chart.update();
}