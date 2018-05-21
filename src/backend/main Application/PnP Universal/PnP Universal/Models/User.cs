using System;
using System.Collections.Generic;

namespace PnP_Universal.Models
{
    public partial class User
    {
        public int Id { get; set; }
        public string Username { get; set; }
        public string Email { get; set; }
        public string Passwort { get; set; }

        public Adventure Adventure { get; set; }
        public Hero Hero { get; set; }
        public Templates Templates { get; set; }
    }
}
