<footer class="footer-bg pt-4">
  <div class="container">
    <div class="row text-dark" style="font-size: 20px;">
      <div class="col-md-3 col-12">
        <h2 class="text-white mb-4">Cursuri populare</h2>
          <div ><a href="/course/1">Curs de Python</a></div>
          <div ><a href="/course/2">Curs de JavaScript</a></div>
          <div ><a href="/course/3">Curs de HTML și CSS</a></div>
      </div>
      <div class="col-md-3 col-12">
        <h2 class="text-white mb-4">Filtrare cursuri</h2>
        <form action="/course" method="get">
          <div class="mb-3 text-white">
            <label for="nivel-dificultate" class="form-label">Nivel dificultate</label>
            <select class="form-select" id="nivel-dificultate" name="nivel" required>
              <option selected value="">Alege nivelul de dificultate</option>
              <option value="incepator">Începător</option>
              <option value="intermediar">Intermediar</option>
              <option value="avansat">Avansat</option>
            </select>
          </div>
          <div class="mb-3 text-white">
            <label for="limbaj-programare" class="form-label">Limbaj programare</label>
            <select class="form-select" id="limbaj-programare" name="search" required>
              <option selected value="">Alege limbajul de programare</option>
              <option value="python">Python</option>
              <option value="javascript">JavaScript</option>
              <option value="html-css">HTML și CSS</option>
            </select>
          </div>
          <button type="submit" class="btn btn-danger w-100">Filtrează</button>
        </form>
      </div>
      <div class="col-md-3 col-12 text-white">
        <h2 class="text-white mb-4">Joc de programare</h2>
        <p>Încearcă jocul nostru de programare pentru a-ți testa abilitățile.</p>
        <button type="button" class="btn btn-danger w-100" data-toggle="modal" data-target="#jocModal">
          Joacă acum
        </button>
      </div>
      <div class="col-md-3 col-12 text-white">
        <h2 class="text-white mb-4">Despre noi</h2>
          <div><a href="/team">Echipa noastră</a></div>
          <div><a href="/contact">Contact</a></div>
          <lidiv><a href="/term">Termeni și condiții</a></div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 d-flex justify-content-center py-4 text-white">
        <div class="copy-text">
          <p>&copy; 2023 E-Learning Platform. Toate drepturile rezervate.</p>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="jocModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="jocModalLabel">Joc de programare</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="intrebare-1">
            <h6>Care dintre următoarele este un limbaj de programare orientat-obiect?</h6>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="intrebare-1" id="intrebare-1-optiune-a" value="a">
              <label class="form-check-label" for="intrebare-1-optiune-a">
                Java
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="intrebare-1" id="intrebare-1-optiune-b" value="b">
              <label class="form-check-label" for="intrebare-1-optiune-b">
                HTML
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="intrebare-1" id="intrebare-1-optiune-c" value="c">
              <label class="form-check-label" for="intrebare-1-optiune-c">
                CSS
              </label>
            </div>
          </div>
          <div id="intrebare-2" class="d-none">
            <h6>Ce reprezintă CSS?</h6>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="intrebare-2" id="intrebare-2-optiune-a" value="a">
              <label class="form-check-label" for="intrebare-2-optiune-a">
                Cascading Style Sheets
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="intrebare-2" id="intrebare-2-optiune-b" value="b">
              <label class="form-check-label" for="intrebare-2-optiune-b">
                Content Style Sheets
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="intrebare-2" id="intrebare--2-optiune-c" value="c">
              <label class="form-check-label" for="intrebare-2-optiune-c">
                Computer Style Sheets
              </label>
            </div>
          </div>
          <div id="rezultat--final" class="d-none">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Închide</button>
          <button type="button" class="btn btn-primary" id="verifica-raspuns">Verifică răspunsul</button>
        </div>
      </div>
    </div>
  </div>
</footer>
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function () {
    var intrebareCurenta = 1;
    var raspunsuriCorecte = 0;

    $('#jocModal').on('show.bs.modal', function () {
      intrebareCurenta = 1;
      raspunsuriCorecte = 0;
      $('#intrebare-1').removeClass('d-none');
      $('#intrebare-2').addClass('d-none');
    });

    $('#verifica-raspuns').click(function () {
      var raspuns = $('input[name=intrebare-' + intrebareCurenta + ']:checked').val();
      if (raspuns == 'a') {
        raspunsuriCorecte++;
      }
      intrebareCurenta++;
      if (intrebareCurenta == 3) {
        var curs = 'Curs de nivel începător';
        if (raspunsuriCorecte == 2) {
          curs = 'Curs de nivel intermediar';
        } else if (raspunsuriCorecte == 3) {
          curs = 'Curs de nivel avansat';
        }
        $('#verifica-raspuns').text('Vezi rezultatul');
        $('#verifica-raspuns').attr('data-bs-dismiss', 'modal');
        $('#intrebare-' + (intrebareCurenta - 1)).addClass('d-none');
        $('#rezultat--final').append('<p>Ai răspuns corect la ' + raspunsuriCorecte + ' din 2 întrebări. Cel mai bun curs pentru tine este: ' + curs + '</p>');
        $('#rezultat--final').removeClass('d-none');
      } else {
        $('#intrebare-' + intrebareCurenta).removeClass('d-none');
        $('#intrebare-' + (intrebareCurenta - 1)).addClass('d-none');
      }
    });
  });
</script>
@endsection