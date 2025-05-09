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
    let harga = document.getElementById(`harga-${idProduk}`).value;
    


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
    jumlah = angkaPerBarang[idProduk];
    const nama = document.getElementById(`nama-${idProduk}`).textContent;
    const harga = document.getElementById(`harga-${idProduk}`).value;
    document.getElementById(`jumlah-${idProduk}`).innerHTML = angkaPerBarang[idProduk];
    

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

    const table = document.getElementById("list-info");

    if(!listBarang[id]){
        listBarang[id] = true;
            const tr = document.createElement("tr");
            const td = document.createElement("td");

            let inputNama = document.createElement("input");
            const tdNama = document.createElement("td");
            inputNama.type = "text";
            inputNama.name = "nama_barang[]";
            inputNama.value = nama;
            inputNama.required = true;
            inputNama.readOnly = true;

            let inputJumlah = document.createElement("input");
            const tdJumlah = document.createElement("td");
            inputJumlah.type = "text";
            inputJumlah.name = "jumlah_satuan[]";
            inputJumlah.value = jumlah + 'pcs';
            inputJumlah.required = true;
            inputJumlah.readOnly = true;


            let inputHarga = document.createElement("input");
            const tdHarga = document.createElement("td");
            inputHarga.type = "text";
            inputHarga.name = "harga[]";
            inputHarga.value = harga ;
            inputHarga.required = true;
            inputHarga.readOnly = true;

            let inputId = document.createElement("input");
            inputId.type = "text";
            inputId.name = "id_barang[]";
            inputId.value = id;
            inputId.required = true;
            inputId.readOnly = true;
            inputId.hidden = true;

            let jml_satuan = document.createElement("input");
            const tdSatuan = document.createElement("td");
            jml_satuan.type = "text";
            jml_satuan.id = `total-harga-${id}`;
            jml_satuan.value = parseInt(jumlah) * parseInt(harga.replace(/[^0-9]/g, ''));
            jml_satuan.disabled = "true";


            tdNama.appendChild(inputNama);
            tdJumlah.appendChild(inputJumlah);
            tdHarga.appendChild(inputHarga);
            tdSatuan.appendChild(jml_satuan);

            tr.appendChild(tdNama);
            tr.appendChild(tdJumlah);
            tr.appendChild(tdHarga);
            tr.appendChild(tdSatuan);

            table.appendChild(tr);


            listBarang[id] = tr;

    }else{
        // Kalau sudah ada, update jumlah saja
        let inputs = listBarang[id].getElementsByTagName("input");
        inputs[1].value = jumlah + 'pcs'; // inputJumlah di urutan kedua

        // jumlahkan per Produk
        let totalHargaProdukInput = document.getElementById(`total-harga-${id}`);
        if (totalHargaProdukInput) {
            totalHargaProdukInput.value = parseInt(jumlah) * parseInt(harga.replace(/[^0-9]/g, ''));
        }
    }


    // function struk_belanja(id, nama, harga, jumlah) {

    //     const ul= document.getElementById("list-info");
    
    //     if(!listBarang[id]){
    //         listBarang[id] = true;
    //             const li = document.createElement("li");
    //             li.style.listStyleType = "none";
    
    
    //             let inputNama = document.createElement("input");
    //             inputNama.type = "text";
    //             inputNama.name = "nama_barang[]";
    //             inputNama.value = nama;
    //             inputNama.required = true;
    //             inputNama.readOnly = true;
    
    //             let inputJumlah = document.createElement("input");
    //             inputJumlah.type = "text";
    //             inputJumlah.name = "jumlah_satuan[]";
    //             inputJumlah.value = jumlah + 'pcs';
    //             inputJumlah.required = true;
    //             inputJumlah.readOnly = true;
    
    
    //             let inputHarga = document.createElement("input");
    //             inputHarga.type = "text";
    //             inputHarga.name = "harga[]";
    //             inputHarga.value = harga ;
    //             inputHarga.required = true;
    //             inputHarga.readOnly = true;
    
    //             let inputId = document.createElement("input");
    //             inputId.type = "text";
    //             inputId.name = "id_barang[]";
    //             inputId.value = id;
    //             inputId.required = true;
    //             inputId.readOnly = true;
    //             inputId.hidden = true;
    
    //             let jml_satuan = document.createElement("input");
    //             jml_satuan.type = "text";
    //             jml_satuan.id = `total-harga-${id}`;
    //             jml_satuan.value = parseInt(jumlah) * parseInt(harga.replace(/[^0-9]/g, ''));
    //             jml_satuan.disabled = "true";
    
    
    //             li.appendChild(inputNama);
    //             li.appendChild(inputJumlah);
    //             li.appendChild(inputHarga);
    //             li.appendChild(inputId);
    //             li.appendChild(jml_satuan);
    
    
    //             ul.appendChild(li);
    
    //             listBarang[id] = li;
    
    //     }else{
    //         // Kalau sudah ada, update jumlah saja
    //         let inputs = listBarang[id].getElementsByTagName("input");
    //         inputs[1].value = jumlah + 'pcs'; // inputJumlah di urutan kedua
    
    //         // jumlahkan per Produk
    //         let totalHargaProdukInput = document.getElementById(`total-harga-${id}`);
    //         if (totalHargaProdukInput) {
    //             totalHargaProdukInput.value = parseInt(jumlah) * parseInt(harga.replace(/[^0-9]/g, ''));
    //         }
    //     }


    
    cekStrukBelanja();


    hitungTotal();
}

// function hittung (){
//     document.getElementById('jml_satuan').value = parseInt(jumlah) * parseInt(harga.replace(/[^0-9]/g, ''));
// }

function hitungTotal() {
    const rows = document.querySelectorAll("#list-info tr");
    let total = 0;

    rows.forEach(row => {
        const inputs = row.querySelectorAll("input");

        if (inputs.length >= 3) { // Pastikan ada minimal 3 input (nama, jumlah, harga)
            const jumlahStr = inputs[1].value.replace('pcs', '').trim();
            const jumlah = parseInt(jumlahStr) || 0;

            const harga = parseInt(inputs[2].value.replace(/[^0-9]/g, '')) || 0;

            const subtotal = jumlah * harga;
            total += subtotal;
        }
    });

    const totalField = document.getElementById("total");
    if (totalField) {
        totalField.value = 'Rp. ' + total.toLocaleString('id-ID');
    }
}



// function hitungTotal() {

//     const list = document.querySelectorAll("#list-info li");
//     let total = 0;
//     list.forEach(li => {
//         const inputs = li.getElementsByTagName("input");

//         const nama = inputs[0].value;
//         const jumlahStr = inputs[1].value.replace('pcs', '').trim(); // hilangkan "pcs"
//         const jumlah = parseInt(jumlahStr) || 0;

//         const harga = parseInt(inputs[2].value.replace(/[^0-9]/g, '')) || 0;
        
//         const subtotal = jumlah * harga;
//         total += subtotal;
//     });
//     document.getElementById("total").value = 'Rp.' + total.toLocaleString('id-ID');


// }

    // cek button

    const btnBayar = document.getElementById('btnBayar');
    const listInfo = document.getElementById('list-info');

    // Fungsi untuk mengaktifkan/menonaktifkan tombol Bayar berdasarkan isi list-info
    function cekStrukBelanja() {
        if (listInfo.children.length > 1) { // Ada item belanja (selain header)
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
