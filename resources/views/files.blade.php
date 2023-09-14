<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="/js/jquery.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
    Launch demo modal
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="background-color: #DAC0A3">
        <div class="modal-header" style="background-color: #DAC0A3">
          <h5 class="modal-title" id="exampleModalLabel">Unggah Data ?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-dialog modal-dialog-centered" style="height: 50%;background-color: #DAC0A3">
          <div class="modal-content" style="background-color: #DAC0A3">
            <div class="modal-body" style="background-color: #DAC0A3;border : 1px solid black;border-radius : 10px;box-shadow: 0px 5px 7px rgba(0, 0, 0, 0.7)">
              <!-- Top Dialog -->
              <div class="container p-3" style="background-color: #DAC0A3">
               <p><b>Data Presensi Peserta</b></p>
               <p>Tanggal Presensi : 10-09-2023</p>
               <p>Kelas : Kid Class</p>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-dialog modal-dialog-centered" style="height: 50%;background-color: #DAC0A3">
          <div class="modal-content" style="background-color: #DAC0A3">
            <div class="modal-body" style="background-color: #DAC0A3;border : 1px solid black;border-radius : 10px;box-shadow: 0px 5px 7px rgba(0, 0, 0, 0.7)">
              <!-- Bottom Dialog -->
              <div class="container p-3"style="background-color: #DAC0A3">
                Apakah anda yakin ingin mengunggah data presensi ?
                <div style="display: flex;justify-content: space-between;margin-top:10px;">
                    <button class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-success">Unggah</button>
                </div>  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>