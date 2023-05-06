type="text/javascript"
		let data_table = document.getElementById("example").tBodies[0].rows;
		let dataBarang = {};

		let id_barangTag = document.getElementById("id_barang");
		let jumlah_barangTag = document.getElementById("jumlah_barang");
		let alamatTag = document.getElementById("alamat");
		let total_harga = document.getElementById("total_harga");
		let button = document.getElementById("pesan");

		function toggleSubmitButton() {
			if (!id_barangTag.value || !jumlah_barangTag.value || !alamatTag.value || !total_harga.value) {
				document.getElementById("pesan").disabled = true;
			} else {
				button.disabled = false;
			}
		}

		function getBarangIDFromTable(idBarangInput) {
			for (let i = 0; i < data_table.length; i++) {
				let id_barang = data_table[i].getElementsByTagName("td")[1].innerHTML;
				if (id_barang == idBarangInput) {
					let hargaBarang = parseFloat(data_table[i].getElementsByTagName("td")[3].innerHTML);
					dataBarang.id_barang = parseInt(idBarangInput);
					dataBarang.harga_barang = hargaBarang;
					toggleSubmitButton()
					hitungTotalHarga(jumlah_barangTag.value)
					return
				}
			}
		}

		function hitungTotalHarga(jumlahBarang) {
			total_harga.value = parseInt(jumlahBarang) * dataBarang.harga_barang;
			toggleSubmitButton()
		}