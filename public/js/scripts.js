/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */



    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

    // tambah jumlah barang
    let angkaPerBarang = {};
    let cart = [];
    let listBarang = {};
    let total = 0;

    // membuat kode transaksi
    const bagianAcak = Math.random().toString().slice(2, 5); // Ambil beberapa digit desimal acak
    const bagianWaktu = new Date();    // Ambil beberapa digit terakhir timestamp
    const kode_transaksi = bagianWaktu.toISOString().slice(0, 10).replace(/-/g, '') + bagianAcak; // Gabungkan keduanya
    const kode_transaksi_input = document.getElementById('kode_transaksi'); 
    kode_transaksi_input.value = kode_transaksi; // Set nilai input dengan ID transaksi


    
    
        
// tambah jumlah barang
function tambah(idProduk) {
    if(!angkaPerBarang[idProduk]){
        angkaPerBarang[idProduk] = 0;
    }
    angkaPerBarang[idProduk]++;

    document.getElementById(`jumlah-${idProduk}`).innerHTML = angkaPerBarang[idProduk];
    

    let nama = document.getElementById(`nama-${idProduk}`).textContent;
    let harga = document.getElementById(`harga-${idProduk}`).textContent;
    


    let index = cart.findIndex(item => item.id === idProduk);
    if (index === -1) {
        cart.push({ id: idProduk, nama_barang: nama, harga_barang: harga, jumlah_barang: angkaPerBarang[idProduk] });
    } else {
        cart[index].jumlah_barang = angkaPerBarang[idProduk];
    }


    struk_belanja(idProduk, nama, harga, angkaPerBarang[idProduk]);

}

// kurangi jumlah barang
function kurang(idProduk) {
    if(!angkaPerBarang[idProduk]){
        angkaPerBarang[idProduk] = 0;
    }

    angkaPerBarang[idProduk]--;
    if (angkaPerBarang[idProduk] < 0) {
        angkaPerBarang[idProduk] = 0;
    }
    jumlah = angkaPerBarang[idProduk]
    document.getElementById(`jumlah-${idProduk}`).innerHTML = angkaPerBarang[idProduk];
    const nama = document.getElementById(`nama-${idProduk}`).textContent;
    const harga = document.getElementById(`harga-${idProduk}`).textContent;

    

    let index = cart.findIndex(item => item.id === idProduk);
    if (index !== -1) {
        cart[index].jumlah_barang = angkaPerBarang[idProduk];
    }
    
        if (angkaPerBarang[idProduk] === 0) {
            if (listBarang[idProduk]) {
                listBarang[idProduk].remove();
                delete listBarang[idProduk];
                
            }
        }else{
            struk_belanja(idProduk, nama, harga, angkaPerBarang[idProduk]);
        }
        cekStrukBelanja();
        hitungTotal();
}

// reset jumlah barang
function reset(idProduk) {

    angkaPerBarang[idProduk] = 0;
    document.getElementById(`jumlah-${idProduk}`).innerHTML = angkaPerBarang[idProduk];
    if (angkaPerBarang[idProduk] === 0) {
        if (listBarang[idProduk]) {
            listBarang[idProduk].remove();
            delete listBarang[idProduk];
        }
    }else{
        struk_belanja(idProduk, '', 0, angkaPerBarang[idProduk]);
    }
    cekStrukBelanja();
    hitungTotal();
}

// membuat struk belanja
function struk_belanja(id, nama, harga, jumlah) {
    const ul = document.getElementById("list-info");
    const hargaNumber = parseInt(harga.replace(/[^0-9]/g, ''));
    const total = parseInt(jumlah) * hargaNumber;

    if (!listBarang[id]) {
        const li = document.createElement('li');
        li.style.listStyleType = "none";
        li.classList = "mb-3";

        const inputNama = document.createElement('input');
        inputNama.type = 'text';
        inputNama.name = 'nama_barang[]';
        inputNama.value = nama;
        inputNama.hidden = true;

        const inputJumlah = document.createElement('input');
        inputJumlah.type = 'text';
        inputJumlah.name = 'jumlah_satuan[]';
        inputJumlah.value = jumlah;
        inputJumlah.hidden = true;

        const inputHarga = document.createElement("input");
        inputHarga.type = 'text';
        inputHarga.name = 'harga[]';
        inputHarga.value = harga;
        inputHarga.hidden = true;

        const inputId = document.createElement("input");
        inputId.type = "text";
        inputId.name = "id_barang[]";
        inputId.value = id;
        inputId.hidden = true;

        const label = document.createElement("span");
        label.textContent = jumlah + 'pcs - ' + nama + ' - ' + harga + ' - ' + total.toLocaleString('id-ID');
        label.classList = "d-block mb-2";

        li.appendChild(label);
        li.appendChild(inputNama);
        li.appendChild(inputJumlah);
        li.appendChild(inputHarga);
        li.appendChild(inputId);

        ul.appendChild(li);

        listBarang[id] = li;

    } else {
        // Update input dan label
        const li = listBarang[id];
        const inputs = li.getElementsByTagName('input');
        const label = li.querySelector('span');

        inputs[1].value = jumlah; // jumlah_satuan[]
        const updatedTotal = parseInt(jumlah) * parseInt(harga.replace(/[^0-9]/g, ''));

        label.textContent = jumlah + 'pcs - ' + nama + ' - ' + harga + ' - ' + updatedTotal.toLocaleString('id-ID');
}

    
    cekStrukBelanja();


    hitungTotal();
}

function hitungTotal() {
    const span = document.querySelectorAll("#list-info span");
    let total = 0;

    span.forEach(lis => {
        const text = lis.textContent.trim();
        const parts = text.split(' - ');

        if(parts.length >= 4){
            const jml = parts[0].replace(/\./g, '').replace(/[^0-9]/g, '');
            const hrg = parts[2].replace(/\./g, '').replace(/[^0-9]/g, ''); // hilangkan titik dan non-digit
            const subtotal = jml * hrg;
            console.log(subtotal);
            if (!isNaN(subtotal)) {
                total += subtotal;
            }
        }
    });
    
    const totalField = document.getElementById("total");
    if (totalField) {
        totalField.value = 'Rp. ' + total.toLocaleString('id-ID');
    }
}


    // cek button

    const btnBayar = document.getElementById('btnBayar');
    const listInfo = document.getElementById('list-info');

    // Fungsi untuk mengaktifkan/menonaktifkan tombol Bayar berdasarkan isi list-info
    function cekStrukBelanja() {
        if (listInfo.children.length > 0) { // Ada item belanja (selain header)
            btnBayar.disabled = false;
        } else {
            btnBayar.disabled = true;
        }
    }




// format uang
$(document).ready(function() {
    $('.money').simpleMoneyFormat();
});

$(document).ready(function() {
    $('.uang').simpleMoneyFormat();
});
