using System;
using System.Collections.Generic;

namespace PnP_Universal.Models
{
    public class final
    {
        public ICollection<own> own {get; set;}
        public ICollection<joined> joined { get; set; }

    }
    public class own
    {
        public int Id { get; set; }
        public string Title { get; set; }
        public string Description { get; set; }
        public string Template_title { get; set; }
    }
    public class joined
    {
        public int Id { get; set; }
        public string Title { get; set; }
        public string Description { get; set; }
        public string own_hero { get; set; }
        public string game_master { get; set; }
        public string template_name { get; set; }

    }
    public class Adventures
    {
        public int Id { get; set; }
        public string Name { get; set; }
        public int Gamemaster { get; set; }
        public int Template { get; set; }
        public string InviteCode { get; set; }
        public string Description { get; set; }
        public Users Id1 { get; set; }
        public Templates IdNavigation { get; set; }
        public Heroes Heroes { get; set; }
        public Items Items { get; set; }
    }
}
