using System;
using System.Collections.Generic;

namespace PnP_Universal.Models
{
    public partial class Hero
    {
        public int Id { get; set; }
        public string Name { get; set; }
        public int Owner { get; set; }
        public int Template { get; set; }
        public int? Adventure { get; set; }
        public string Stats { get; set; }
        public string Inventory { get; set; }

        public Templates Id1 { get; set; }
        public User Id2 { get; set; }
        public Adventure IdNavigation { get; set; }
    }
}
