/**
 * main.js file.
 * Created at 11.03.2015
 *
 * @author Meelis-Marius Pinka <meelis@c0de.ee>
 * @copyright Copyright &copy; 2015 Code OÜ
 */

(function() {
    var app = angular.module('flicktTest', []);

    app.directive('imageContainer', function () {
        return {
            link: function(scope, element, attrs) {
                var hover = function() {
                    $('.img-title', $(this).parent()).css('opacity', 1);
                }

                var unHover = function() {
                    $('.img-title', $(this).parent()).css('opacity', 0);
                }

                element.hover(hover, unHover);
            }
        }
    });

    app.directive('image', function ($window) {
        return {
            link: function(scope, element, attrs) {
                var setImg = function() {
                    var imgC = $(this).parent().parent();
                    var height = imgC.children('.image').height();
                    var titleContainer = imgC.find('.title-container');

                    $(this).css('marginTop', (height - $(this).height()) / 2 + 'px');
                    imgC.find('.img-background').css('width', imgC.width() + 'px');

                    titleContainer.css('bottom', titleContainer.children().height() + 'px');
                    element.parent().parent().css('opacity', 1);
                }

                element.load(setImg).error(function() {
                    $(this).parent().parent().remove();
                });
                angular.element($window).bind('resize', function() {
                    element.trigger('load');
                });
            }
        }
    });

    app.controller('MainCtrl', function ($scope, $http, $location) {
        $scope.loading = false;
        $scope.searchTags = $location.search().tags;

        $scope.search = function () {
            $scope.loading = true;

            $http.post('image', {tags: $scope.searchTags}).success(function (result) {
                $scope.images = result.images;
                $scope.cached = result.cached;
                $scope.error = result.error;
                $scope.loading = false;

                if (!result.error) {
                    $location.search('tags', $scope.searchTags);
                    $scope.shareLink = $location.absUrl();
                }
            }).error(function () {
                $scope.loading = false;
                $scope.error = 'Failed to connect to server';
            });
        }

        if ($scope.searchTags) {
            $scope.search();
        }
    });
}());

