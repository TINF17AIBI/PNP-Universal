package main

import (
	"io/ioutil"
	"net/http"

	"github.com/labstack/echo"
	"github.com/labstack/echo/middleware"
)

func main() {
	e := echo.New()

	e.GET("/api/heroes", func(c echo.Context) (err error) {
		return sendJSON(c, "data/heros.json")
	}, auth())

	e.GET("/api/adventures", func(c echo.Context) (err error) {
		return sendJSON(c, "data/adventures.json")
	}, auth())

	e.GET("/api/adventure/:id", func(c echo.Context) (err error) {
		return sendJSON(c, "data/adventure"+c.Param("id")+".json")
	}, auth())

	e.GET("/api/templates", func(c echo.Context) (err error) {
		return sendJSON(c, "data/templates.json")
	}, auth())

	e.GET("/api/template/:id", func(c echo.Context) (err error) {
		return sendJSON(c, "data/template"+c.Param("id")+".json")
	}, auth())

	e.Logger.Fatal(e.Start("127.0.0.1:9090"))
}

func sendJSON(c echo.Context, path string) error {
	bytes, err := ioutil.ReadFile(path)
	if len(bytes) == 0 || err != nil {
		return err
	}
	return c.JSONBlob(http.StatusOK, bytes)
}

func auth() echo.MiddlewareFunc {
	return middleware.BasicAuth(func(u, p string, c echo.Context) (bool, error) {
		return u == "username" && p == "password", nil
	})
}
