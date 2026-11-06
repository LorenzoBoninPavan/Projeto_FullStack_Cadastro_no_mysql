                <!-- jQuery e jQuery Mask Plugin -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

                <script>
                    $(document).ready(function(){
                        $("#placaVeiculo").mask('AAA-0C00', {
                            translation: {
                                'A': { pattern: /[A-Za-z]/ }, // Aceita apenas letras (A-Z)
                                '0': { pattern: /[0-9]/ }, // Aceita apenas números (0-9)
                                'C': { pattern: /[A-Ja-j]/ } // Aceita apenas letras A-J
                            }
                        });

                        // Converte automaticamente para maiúsculas
                        $("#placaVeiculo").on('keyup', function() {
                            this.value = this.value.toUpperCase();
                        });
                    });
                </script>
                
                <!-- Bootstrap 5 JS (para validação e outros scripts) -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            
            </div>
        </div>
    </div>

    <!-- Rodapé do Sistema -->
    <div class="mt-5 bg-primary text-white text-center fixed-bottom">
        <p>Avaliação - Programação Web - <?php echo $ano;?></p>
    </div>

</body>
</html>