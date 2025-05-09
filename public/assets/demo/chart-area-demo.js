fetch('/grafik')
  .then(response => response.json())
  .then(data => {
    const label = data.harian.map(item => `${item.tanggal} ${item.bulan} ${item.tahun}`);
    const values = data.harian.map(item => item.total.toLocaleString('id-ID')); 

    const ctx = document.getElementById("myAreaChart").getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: label,
        datasets: [{
          label: "Penghasilan",
          lineTension: 0.3,
          backgroundColor: "rgba(2,117,216,0.2)",
          borderColor: "rgba(2,117,216,1)",
          pointRadius: 5,
          pointBackgroundColor: "rgba(2,117,216,1)",
          pointBorderColor: "rgba(255,255,255,0.8)",
          pointHoverRadius: 5,
          pointHoverBackgroundColor: "rgba(2,117,216,1)",
          pointHitRadius: 50,
          pointBorderWidth: 2,
          data: values
        }]
      },
      options: {
        scales: {
          x: {
            ticks: {
              maxTicksLimit: 7
            },
            grid: {
              display: false
            }
          },
          y: {
            beginAtZero: true,
            ticks: {
              maxTicksLimit: 5
            },
            grid: {
              display: true
            }
          }
        }
      }
      
    });
  });
