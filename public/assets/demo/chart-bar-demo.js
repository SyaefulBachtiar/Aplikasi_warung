fetch('/grafik')
  .then(response => response.json())
  .then(data => {
    const label = data.bulanan.map(item => item.nama_bulan);
    const values = data.bulanan.map(item => item.total.toLocaleString('id-ID'));

    const ctx = document.getElementById("myBarChart").getContext('2d');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: label,
        datasets: [{
          label: "Penghasilan",
          backgroundColor: "rgba(2,117,216,1)",
          borderColor: "rgba(2,117,216,1)",
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
