using System;
using System.Collections.Generic;

namespace PnP_Universal.Models
{
    public partial class Users
    {
        public int Id { get; set; }
        public string Username { get; set; }
        public string Password { get; set; }

        public Adventures Adventures { get; set; }
        public Heroes Heroes { get; set; }
        public Templates Templates { get; set; }
    }
}
