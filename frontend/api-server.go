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
	g.GET("/heroes", sendJSON("heros"))
	g.GET("/adventures", sendJSON("adventures"))
	g.GET("/adventure/:id", sendJSON("adventure"))
	g.GET("/templates", sendJSON("templates"))
	g.GET("/template/:id", sendJSON("template"))
	e.Logger.Fatal(e.Start("127.0.0.1:9090"))
}

func sendJSON(file string) echo.HandlerFunc {
	return func(c echo.Context) error {
		bytes, err := ioutil.ReadFile("data/" + file + c.Param("id") + ".json")
		if len(bytes) == 0 || err != nil {
			return err
		}
		return c.JSONBlob(http.StatusOK, bytes)
	}
}
