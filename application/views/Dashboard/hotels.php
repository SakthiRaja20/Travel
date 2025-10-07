        <!-- Header  -->
        <?php
        include('layout/header.php');
        ?>

        <!-- Start aside  -->
        <aside>
            <style>
                .search_add {
                    width: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    border-radius: 10px 10px 0 0;
                    background: #fff;
                    padding: 10px;
                }

                .search_add input {
                    outline: navajowhite;
                    padding: 8px 10px;
                    border-radius: 10px;
                    border: 1px solid #8080803d;
                }

                .search_add button {
                    background: #1b2c56;
                    color: #fff;
                    padding: 5px 10px;
                    border: navajowhite;
                    font-size: 12px;
                    box-shadow: 0 0 20px rgb(0, 0, 0, .2);
                    cursor: pointer;
                    border-radius: 10px;
                }

                /* Data Table  */
                .dataTable {
                    width: 100%;
                    height: calc(100vh - 135px);
                    background: #fff;
                    border-radius: 0 0 10px 10px;
                    overflow-y: auto;
                }

                .dataTable::-webkit-scrollbar {
                    display: none;
                }

                .dataTable table {
                    width: 100%;
                    border-collapse: collapse;
                }

                .dataTable table th,
                td,
                tr {
                    text-align: center;
                    padding: 3px 5px;
                    font-size: 13px;
                }

                .dataTable table thead {
                    background: #fff;
                    box-shadow: 0 10px 20px rgb(0, 0, 0, .2);
                    border-radius: 10px;
                    padding: 8px 0;
                    position: sticky;
                    top: 0;
                    margin: 10px 0;
                }

                .dataTable table thead tr th {
                    padding: 10px 0;
                }

                .dataTable table tbody tr td {
                    padding: 6px 0;
                }

                .dataTable table tbody tr td img {
                    width: 25px;
                    height: 25px;
                    border-radius: 5px;
                }

                .dataTable table tbody tr td button {
                    background: #1b2c56;
                    color: #fff;
                    padding: 5px 10px;
                    border: navajowhite;
                    font-size: 11px;
                    cursor: pointer;
                    border-radius: 8px;
                }


                /* Add Form  */
                .add_form {
                    width: 100%;
                    height: 100%;
                    display: none;
                    align-items: center;
                    justify-content: center;
                    position: absolute;
                    left: 0;
                    top: 0;
                    background: rgb(0, 0, 0, .1);
                    z-index: 999;
                }

                .add_form form {
                    position: relative;
                    width: 65%;
                    padding: 25px;
                    box-shadow: 0 0 20px rgb(0, 0, 0, .2);
                    border-radius: 10px;
                    background: #fff;
                    display: flex;
                    align-items: center;
                    flex-wrap: wrap;
                    gap: 1%;
                }

                .add_form form .card {
                    position: relative;
                    display: flex;
                    flex-direction: column;
                    width: 24%;
                    margin-bottom: 10px;
                }

                .add_form form .card label {
                    font-weight: 600;
                    font-size: 13px;
                }

                .add_form form .card input {
                    padding: 8px 10px;
                    border: 1px solid rgba(128, 128, 128, 0.26);
                    border-radius: 8px;
                    outline: none;
                    margin-top: 5px;
                }

                .add_form form .bi-x-circle-fill {
                    position: absolute;
                    top: -14px;
                    right: -7px;
                    cursor: pointer;
                    font-size: 20px;
                }

                .add_form form .card img {
                    width: 55px;
                    height: 35px;
                    position: absolute;
                    right: 2px;
                    top: 27px;
                    border-radius: 8px;
                    z-index: 999;
                    border: 3px solid #fff;
                    box-shadow: 0 0 20px rgb(0, 0, 0, .2);
                    display: none;
                }

                .add_form form .card_submit {
                    width: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .add_form form .card_submit input {
                    width: 100px;
                    background: #000;
                    color: #fff;
                    border: 1px solid #000;
                    cursor: pointer;
                    transition: .3s linear;
                }

                .add_form form .card_submit input:hover {
                    background: transparent;
                    color: #000;
                }
            </style>

            <div class="search_add">
                <input type="text" placeholder="search" id="search">
                <button id="form_btn"><i class="bi bi-plus"></i> Add</button>
            </div>

            <!-- Data Table  -->
            <div class="dataTable">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Poster</th>
                            <th>Hotel Name</th>
                            <th>City</th>
                            <th>MRP</th>
                            <th>Discount</th>
                            <th>Rooms</th>
                            <th>Edit</th>
                        </tr>
                    </thead>

                    <tbody id="hotels">

                    </tbody>
                </table>
            </div>


            <!-- Add Form -->
            <div class="add_form" id="hotelAdd">
                <form action="#">
                    <i class="bi bi-x-circle-fill" id="hotelAddExit"></i>

                    <div class="card">
                        <label for="">Hotel Name</label>
                        <input type="text" placeholder="hotel name" id="name">
                    </div>

                    <div class="card">
                        <label for="">Decription</label>
                        <input type="text" placeholder="decription" id="dec">
                    </div>

                    <div class="card">
                        <label for="">City</label>
                        <input type="text" placeholder="city" id="city">
                    </div>

                    <div class="card">
                        <label for="">Rate</label>
                        <input type="text" placeholder="rate" id="rate">
                    </div>

                    <div class="card">
                        <label for="">Mrp</label>
                        <input type="text" placeholder="mrp" id="mrp">
                    </div>

                    <div class="card">
                        <label for="">Discount</label>
                        <input type="text" placeholder="discount" id="discount">
                    </div>

                    <div class="card">
                        <label for="">Location</label>
                        <input type="text" placeholder="location" id="loc">
                    </div>

                    <div class="card">
                        <label for="">lat</label>
                        <input type="text" placeholder="lat" id="lat">
                    </div>

                    <div class="card">
                        <label for="">log</label>
                        <input type="text" placeholder="log" id="log">
                    </div>

                    <div class="card">
                        <label for="">Services</label>
                        <input type="text" placeholder="gym, wifi, parking" id="services">
                    </div>

                    <div class="card">
                        <label for="">Food</label>
                        <input type="text" placeholder="breakfast, launch" id="food">
                    </div>

                    <div class="card">
                        <label for="">Poster</label>
                        <input type="file" placeholder="poster.jpg" id="poster" onchange="uploadImage('poster' , 'preview')">
                        <img src="#" id="preview">
                    </div>

                    <div class="card">
                        <label for="">Room Poster 1</label>
                        <input type="file" placeholder="abc.jpg, abc1.jpg" id="poster1" onchange="uploadImage('poster1' , 'preview1')">
                        <img src="#" id="preview1">
                    </div>

                    <div class="card">
                        <label for="">Room Poster 2</label>
                        <input type="file" placeholder="abc.jpg, abc1.jpg" id="poster2" onchange="uploadImage('poster2' , 'preview2')">
                        <img src="#" id="preview2">
                    </div>

                    <div class="card">
                        <label for="">Rooms</label>
                        <input type="number" placeholder="50" id="room">
                    </div>


                    <div class="card card_submit">
                        <input type="submit" value="Submit" id="addSubmit">
                    </div>

                </form>
            </div>



            <!-- Edit Form -->
            <div class="add_form" id="hotelEdit">
                <form action="#">
                    <i class="bi bi-x-circle-fill" id="hotelEditExit"></i>
                    <div class="card">
                        <label for="">Hotel Name</label>
                        <input type="text" placeholder="hotel name" id="name_edit">
                    </div>
                    <div class="card">
                        <label for="">Decription</label>
                        <input type="text" placeholder="decription" id="dec_edit">
                    </div>
                    <div class="card">
                        <label for="">City</label>
                        <input type="text" placeholder="city" id="city_edit">
                    </div>
                    <div class="card">
                        <label for="">Rate</label>
                        <input type="text" placeholder="rate" id="rate_edit">
                    </div>
                    <div class="card">
                        <label for="">Mrp</label>
                        <input type="text" placeholder="mrp" id="mrp_edit">
                    </div>
                    <div class="card">
                        <label for="">Discount</label>
                        <input type="text" placeholder="discount" id="discount_edit">
                    </div>
                    <div class="card">
                        <label for="">Location</label>
                        <input type="text" placeholder="location" id="loc_edit">
                    </div>
                    <div class="card">
                        <label for="">lat</label>
                        <input type="text" placeholder="lat" id="lat_edit">
                    </div>
                    <div class="card">
                        <label for="">log</label>
                        <input type="text" placeholder="log" id="log_edit">
                    </div>
                    <div class="card">
                        <label for="">Services</label>
                        <input type="text" placeholder="gym, wifi, parking" id="services_edit">
                    </div>
                    <div class="card">
                        <label for="">Food</label>
                        <input type="text" placeholder="breakfast, launch" id="food_edit">
                    </div>
                    <div class="card">
                        <label for="">Poster</label>
                        <input type="file" placeholder="poster.jpg" id="poster_edit" onchange="uploadImage('poster_edit' , 'preview_edit')">
                        <img src="#" id="preview_edit" style="display: flex;">
                    </div>
                    <div class="card">
                        <label for="">Room Poster 1</label>
                        <input type="file" placeholder="abc.jpg, abc1.jpg" id="poster1_edit" onchange="uploadImage('poster1_edit' , 'preview1_edit')">
                        <img src="#" id="preview1_edit" style="display: flex;">
                    </div>
                    <div class="card">
                        <label for="">Room Poster 2</label>
                        <input type="file" placeholder="abc.jpg, abc1.jpg" id="poster2_edit" onchange="uploadImage('poster2_edit' , 'preview2_edit')">
                        <img src="#" id="preview2_edit" style="display: flex;">
                    </div>
                    <div class="card">
                        <label for="">Rooms</label>
                        <input type="number" placeholder="50" id="room_edit">
                    </div>

                    <div class="card card_submit">
                        <input type="submit" value="Submit" data="" id="submit_edit">
                    </div>
                </form>
            </div>


            <script>
                let uploadImage = (id, pre) => {
                    const fileInput = document.getElementById(id);
                    const file = fileInput.files[0];
                    const formData = new FormData();
                    formData.append('userfile', file);
                    // console.log(formData  , fileInput , file);

                    fetch("<?php echo base_url('Dashboard/img_uplaod') ?>", {
                            method: 'POST',
                            body: formData
                        }).then(response => response.json())
                        .then(data => {
                            if (data.status == 'success') {
                                document.getElementById(pre).src = data.img_url;
                                document.getElementById(pre).style.display = 'block';
                                alert('Image Upload successfully');



                            } else {
                                alert('Image Upload failed');
                            }
                        }).catch(error => {
                            console.log(error);
                        })

                }
            </script>

            <script>
                let fetchAllHotels = async () => {
                    try {
                        const response = await fetch("<?php echo base_url("Dashboard/all_hotels") ?>", {
                            method: 'GET',
                            headers: {
                                "Contnet-Type": "application/json"
                            }
                        });

                        const data = await response.json();

                        if (data) {
                            document.getElementById('hotels').innerHTML = '';
                            data.forEach(element => {
                                let card = document.createElement('tr');
                                card.innerHTML = `

                                            <td>${element.id}</td>
                            <td><img src="<?php echo base_url('/assets/img/Hotels-photos/'); ?>${element.poster}" alt="${element.name}" ></td>
                            <td>${element.name}</td>
                            <td>${element.city}</td>
                            <td>${element.mrp}</td>
                            <td>${element.discount}</td>
                            <td>${element.rooms}</td>
                            <td><button class="edit" data="${element.id}?${element.name}?${element.description}?${element.city}?${element.rate}?${element.mrp}?${element.discount}?${element.location}?${element.lat}?${element.log}?${element.services}?${element.food}?${element.poster}?${element.room_andHotelImages}?${element.rooms}"><i class="bi bi-pencil-square"></i> Edit</button></td>

                                `;

                                document.getElementById('hotels').appendChild(card);
                            });

                            edit();

                        }
                    } catch (error) {
                        console.log(error);
                    }
                }

                fetchAllHotels()


                let fetchAllHotelsSearch = async (value) => {
                    try {
                        const response = await fetch("<?php echo base_url("Dashboard/find_hotels") ?>", {
                            method: 'POST',
                            headers: {
                                "Contnet-Type": "application/json"
                            },
                            body: JSON.stringify({
                                value
                            })
                        });

                        const data = await response.json();

                        if (data) {
                            document.getElementById('hotels').innerHTML = '';
                            data.forEach(element => {
                                let card = document.createElement('tr');
                                card.innerHTML = `

                                            <td>${element.id}</td>
                            <td><img src="<?php echo base_url('/assets/img/Hotels-photos/'); ?>${element.poster}" alt="${element.name}" ></td>
                            <td>${element.name}</td>
                            <td>${element.city}</td>
                            <td>${element.mrp}</td>
                            <td>${element.discount}</td>
                            <td>${element.rooms}</td>
                            <td><button class="edit" data="${element.id}?${element.name}?${element.description}?${element.city}?${element.rate}?${element.mrp}?${element.discount}?${element.location}?${element.lat}?${element.log}?${element.services}?${element.food}?${element.poster}?${element.room_andHotelImages}?${element.rooms}"><i class="bi bi-pencil-square"></i> Edit</button></td>

                                `;

                                document.getElementById('hotels').appendChild(card);
                            });

                            edit();

                        }
                    } catch (error) {
                        console.log(error);
                    }
                }


                document.getElementById('search').addEventListener('keyup', (e) => {
                    let value = e.target.value;


                    if (value.length != 0) {
                        fetchAllHotelsSearch(value);
                    } else {
                        fetchAllHotels()
                    }
                })


                let edit = () => {
                    Array.from(document.getElementsByClassName('edit')).forEach((el) => {
                        el.addEventListener('click', () => {
                            let data = el.getAttribute('data').split('?');
                            console.log(data)
                            document.getElementById('hotelEdit').style.display = 'flex';


                            document.getElementById('submit_edit').setAttribute('data', data[0]);
                            document.getElementById('name_edit').value = data[1];
                            document.getElementById('dec_edit').value = data[2];
                            document.getElementById('city_edit').value = data[3];
                            document.getElementById('rate_edit').value = data[4];
                            document.getElementById('mrp_edit').value = data[5];
                            document.getElementById('discount_edit').value = data[6];
                            document.getElementById('loc_edit').value = data[7];
                            document.getElementById('lat_edit').value = data[8];
                            document.getElementById('log_edit').value = data[9];
                            document.getElementById('services_edit').value = data[10];
                            document.getElementById('food_edit').value = data[11];
                            document.getElementById('preview_edit').src = '<?php echo base_url('/assets/img/Hotels-photos/'); ?>' + data[12].replaceAll(' ', '') || null;
                            document.getElementById('preview1_edit').src = '<?php echo base_url('/assets/img/Hotels-photos/'); ?>' + data[13].split(',')[0].replaceAll(' ', '') || null;
                            document.getElementById('preview2_edit').src = '<?php echo base_url('/assets/img/Hotels-photos/'); ?>' + data[13].split(',')[1].replaceAll(' ', '') || null;
                            document.getElementById('room_edit').value = data[14];

                        })
                    })
                }


                document.getElementById('hotelEditExit').addEventListener('click', () => {
                    document.getElementById('hotelEdit').style.display = 'none';
                })
            </script>

            <!-- Hotel Add  -->
            <script>
                document.getElementById('hotelAddExit').addEventListener('click', () => {
                    document.getElementById('hotelAdd').style.display = 'none';
                })
                document.getElementById('form_btn').addEventListener('click', () => {
                    document.getElementById('hotelAdd').style.display = 'flex';
                })


                document.getElementById('addSubmit').addEventListener('click', async () => {
                    let name = document.getElementById('name').value;
                    let dec = document.getElementById('dec').value;
                    let city = document.getElementById('city').value;
                    let rate = document.getElementById('rate').value;
                    let mrp = document.getElementById('mrp').value;
                    let discount = document.getElementById('discount').value;
                    let loc = document.getElementById('loc').value;
                    let lat = document.getElementById('lat').value;
                    let log = document.getElementById('log').value;
                    let services = document.getElementById('services').value;
                    let food = document.getElementById('food').value;
                    let preview = document.getElementById('preview').src.split('/').reverse()[0];
                    let preview1 = document.getElementById('preview1').src.split('/').reverse()[0];
                    let preview2 = document.getElementById('preview2').src.split('/').reverse()[0];
                    let room = document.getElementById('room').value;

                    if (name != '' && dec != '' && city != '' && rate != '' && mrp != '' && discount != '' && loc != '' && lat != '' && log != '' && services != '' && food != '' && preview != '' && preview1 != '' && preview2 != '' && room != '') {
                        try {
                            const response = await fetch('<?php echo base_url('Dashboard/insert_hotel') ?>', {
                                method: 'POST',
                                headers: {
                                    "Content-Type": "application/json"
                                },
                                body: JSON.stringify({
                                    name,
                                    dec,
                                    city,
                                    rate,
                                    mrp,
                                    discount,
                                    loc,
                                    lat,
                                    log,
                                    services,
                                    food,
                                    preview,
                                    preview1,
                                    preview2,
                                    room
                                })
                            });

                            let data = await response.json();

                            if (data) {
                                alert(data.message);
                                window.location.reload();
                            }
                        } catch (error) {
                            console.log(error)
                        }
                    } else {
                        alert('Please Fill All Inputs');
                    }


                })
            </script>


            <!-- Hotel Edit  -->
            <script>
                document.getElementById('submit_edit').addEventListener('click', async () => {
                    let name = document.getElementById('name_edit').value;
                    let dec = document.getElementById('dec_edit').value;
                    let city = document.getElementById('city_edit').value;
                    let rate = document.getElementById('rate_edit').value;
                    let mrp = document.getElementById('mrp_edit').value;
                    let discount = document.getElementById('discount_edit').value;
                    let loc = document.getElementById('loc_edit').value;
                    let lat = document.getElementById('lat_edit').value;
                    let log = document.getElementById('log_edit').value;
                    let services = document.getElementById('services_edit').value;
                    let food = document.getElementById('food_edit').value;
                    let preview = document.getElementById('preview_edit').src.split('/').reverse()[0];
                    let preview1 = document.getElementById('preview1_edit').src.split('/').reverse()[0];
                    let preview2 = document.getElementById('preview2_edit').src.split('/').reverse()[0];
                    let room = document.getElementById('room_edit').value;
                    let id = document.getElementById('submit_edit').getAttribute('data');

                    if (name != '' && dec != '' && city != '' && rate != '' && mrp != '' && discount != '' && loc != '' && lat != '' && log != '' && services != '' && food != '' && preview != '' && preview1 != '' && preview2 != '' && room != '') {
                        try {
                            const response = await fetch('<?php echo base_url('Dashboard/update_hotel') ?>', {
                                method: 'POST',
                                headers: {
                                    "Content-Type": "application/json"
                                },
                                body: JSON.stringify({
                                    name,
                                    dec,
                                    city,
                                    rate,
                                    mrp,
                                    discount,
                                    loc,
                                    lat,
                                    log,
                                    services,
                                    food,
                                    preview,
                                    preview1,
                                    preview2,
                                    room,
                                    id
                                })
                            });

                            let data = await response.json();

                            if (data) {
                                alert(data.message);
                                window.location.reload();
                            }
                        } catch (error) {
                            console.log(error)
                        }
                    } else {
                        alert('Please Fill All Inputs');
                    }


                })
            </script>
        </aside>

        </header>


        </body>

        </html>