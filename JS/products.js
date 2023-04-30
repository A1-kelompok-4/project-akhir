       // elemen input search
       const searchInput = document.getElementById('search');

       // elemen button search
       const searchButton = document.getElementById('submit');
       
       // elemen button sort
       const sortAscButton = document.getElementById('sortAsc');
       const sortDescButton = document.getElementById('sortDesc');
       
       // elemen tabel
       const table = document.querySelector('table');
       
       // Fungsi untuk mencari data pada tabel
       const searchTable = () => {
           const searchText = searchInput.value.toLowerCase();
       
           for (let i = 1; i < table.rows.length; i++) {
               const row = table.rows[i];
               const name = row.cells[2].textContent.toLowerCase();
       
               if (name.includes(searchText)) {
                   row.style.display = '';
               } else {
                   row.style.display = 'none';
               }
           }
       };
       
       // Menambahkan event listener untuk button search
       searchButton.addEventListener('click', searchTable);
       
       // Fungsi untuk mengurutkan data berdasarkan harga
       const sortTable = (direction) => {
           const rows = Array.from(table.rows).slice(1);
           const sortedRows = rows.sort((a, b) => {
               const aPrice = parseFloat(a.cells[3].textContent.replace(/[^\d.-]/g, ''));
               const bPrice = parseFloat(b.cells[3].textContent.replace(/[^\d.-]/g, ''));
               return direction === 'asc' ? aPrice - bPrice : bPrice - aPrice;
           });
           table.tBodies[0].append(...sortedRows);
       };
       
       // Menambahkan event listener untuk tombol sort
       sortAscButton.addEventListener('click', () => sortTable('asc'));
       sortDescButton.addEventListener('click', () => sortTable('desc'));
       
       // Menambahkan event listener untuk input search agar dapat mencari data ketika tombol enter ditekan
       searchInput.addEventListener('keyup', (e) => {
           if (e.keyCode === 13) {
               searchTable();
           }
       });       