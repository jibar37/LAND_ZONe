 <!-- Bootstrap core JavaScript
    ================================================== -->
 <!-- Placed at the end of the document so the pages load faster -->
 <script type="text/javascript">
     let off = document.getElementById("offline");
     let on = document.getElementById("online");
     window.addEventListener('offline', (e) => {
         console.log('offline');
         off.style.display = 'block';
         on.style.display = 'none';

     });

     window.addEventListener('online', function() {
         console.log('online');
         let hidden = document.getElementById("offline");
         off.style.display = 'none';
         on.style.display = 'block';
     });
 </script>
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <script>
     window.jQuery || document.write('<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"><\/script>')
 </script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.7/holder.min.js"></script>

 <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
 <script>
     feather.replace()
 </script>

 <script>
     Holder.addTheme('thumb', {
         bg: '#55595c',
         fg: '#eceeef',
         text: 'Thumbnail'
     });
 </script>
 </body>

 </html>