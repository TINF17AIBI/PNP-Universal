using System;
using System.Collections.Generic;

namespace PnP_Universal.Models
{
    public partial class Templates
    {
        public int Id { get; set; }
        public int Creator { get; set; }
        public string Rules { get; set; }

        public User IdNavigation { get; set; }
        public Adventure Adventure { get; set; }
        public Hero Hero { get; set; }
    }
}
