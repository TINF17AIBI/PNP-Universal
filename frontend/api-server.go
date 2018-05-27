package main

import (
	"io/ioutil"
	"net/http"

	"github.com/labstack/echo"
	"github.com/labstack/echo/middleware"
)

func main() {
	e := echo.New()

	g := e.Group("/api")

	g.Use(middleware.BasicAuth(func(u, p string, c echo.Context) (bool, error) {
		return u == "username" && p == "password", nil
	}))

	g.GET("/heroes", func(c echo.Context) (err error) {
		return sendJSON(c, "data/heros.json")
	})

	g.GET("/adventures", func(c echo.Context) (err error) {
		return sendJSON(c, "data/adventures.json")
	})

	g.GET("/adventure/:id", func(c echo.Context) (err error) {
		return sendJSON(c, "data/adventure"+c.Param("id")+".json")
	})

	g.GET("/templates", func(c echo.Context) (err error) {
		return sendJSON(c, "data/templates.json")
	})

	g.GET("/template/:id", func(c echo.Context) (err error) {
		return sendJSON(c, "data/template"+c.Param("id")+".json")
	})

	e.Logger.Fatal(e.Start("127.0.0.1:9090"))
}

func sendJSON(c echo.Context, path string) error {
	bytes, err := ioutil.ReadFile(path)
	if len(bytes) == 0 || err != nil {
		return err
	}
	return c.JSONBlob(http.StatusOK, bytes)
}
