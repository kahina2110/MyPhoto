<div id="overlay" style="display: none;">
                    <div id="lightbox">
                        <img id="photo" src="" alt="">
                        <p id="caption"></p>
                        <div class="infos">
                            <p id="reference"></p>
                            <p id="category"></p>
                        </div>
                        <button id="prevBtn" class="navBtn"><img src="<?= get_stylesheet_directory_uri() . '/PhotosNMota/precedent.png'?>"></button>
                        <button id="nextBtn" class="navBtn"><img src="<?= get_stylesheet_directory_uri() . '/PhotosNMota/suivant.png'?>"></button>
                        <button id="closeBtn">X</button>
                    </div>
                </div>

                <script src="<?php echo get_template_directory_uri(); ?>/js/lightbox.js">
