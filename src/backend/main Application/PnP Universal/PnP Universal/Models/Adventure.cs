using System;
using System.Collections.Generic;

namespace PnP_Universal.Models
{
    public partial class Adventure
    {
        public int Id { get; set; }
        public string Name { get; set; }
        public int Gamemaster { get; set; }
        public int Template { get; set; }

        public User Id1 { get; set; }
        public Templates IdNavigation { get; set; }
        public Hero Hero { get; set; }
    }
}
