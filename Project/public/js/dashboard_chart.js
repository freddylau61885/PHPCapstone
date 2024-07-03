$(document).ready(function () {

    //Retrieve data from GetChartDataController
    $.post("/char_data", function (d) {            
        data = JSON.parse(d);
        let breeds_chard = document.getElementById('breeds_chart');
        let ages_chard = document.getElementById('ages_chart');
        let status_chard = document.getElementById('status_chart');
        let users_chart = document.getElementById('users_chart');

        if (breeds_chard && data['breeds']) {
            initChart(breeds_chard, data['breeds'], "Breeds Segments");
        }

        if (ages_chard && data['ages']) {
            initChart(ages_chard, data['ages'], "Ages Segments");
        }

        if (status_chard && data['status']) {
            initChart(status_chard, data['status'], "Application Status");
        }

        if (users_chart && data['users']) {
            initChart(users_chart, data['users'], "Subscribers");
        }
    });

});

/**
 * Init the char in dashboard
 * 
 * @param {dom object} dom 
 * @param {array} data 
 * @param {string} chart_name 
 */
function initChart(dom, data, chart_name) {
    let chart = echarts.init(dom);
    let option;

    option = {
        title: {
            text: chart_name,  
            left: 'center'          
        },
        tooltip: {
            trigger: 'item'
        },
        legend: {
            top: '5%',
            left: 'center'
        },
        series: [
            {
                name: chart_name,
                type: 'pie',
                radius: ['40%', '70%'],
                avoidLabelOverlap: false,
                label: {
                    show: false,
                    position: 'center'
                },
                emphasis: {
                    label: {
                        show: true,
                        fontSize: '20',
                        fontWeight: 'bold'
                    }
                },
                labelLine: {
                    show: false
                },
                data: data
            }
        ]
    };

    option && chart.setOption(option);
}